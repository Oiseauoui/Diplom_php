<?php

class Products_Admin_Controller extends Admin_Controller {
	
    //niz koji se koristi pri dodavanju slika proizvoda razlicitih velicina
    public $thumbs = array(
                           '160x160' => array('width' => 160, 'height' => 160),
                           '300x300' => array('width' => 300, 'height' => 300),

                          );
    /***************************************************************************
    1. KATEGORIJE
    ***************************************************************************/
    public function category() {
        $this->view->activeNavigation = 'kategorije'; //navigaciju 'Kategorije' postavlja na aktivno
        $categories = $this->model->getAdminCategories(); //poziva metodu iz modula koja vraca podatke o kategorijama
        $this->view->categories = $categories; //pravi svojstvo kome dodeljuje podatke o kategorijama
        $this->view->render('products/kategorije.php'); //prikazuje kategorije
    }

    public function addCategory() {

        $name = $_POST['name'];
        $status = $_POST['active'];
        $imaKat = $this->model->checkCatName($name);

        if ($imaKat){
            header('Location:' . ADMIN_URL . 'products/category?msg=5'); //5 - kategorija sa tim nazivom vec postoji
            die();
        }

        $result = $this->model->addCategory($name,$status); //poziva metodu modula koja dodaje kategoriju
        if ($result){
        header('Location: ' . ADMIN_URL . 'products/category?error=1'); //vraca poruku o uspesnom dodavanju category
        } else{
             header('Location: ' . ADMIN_URL . 'products/category?error=2'); //poruka o neuspesnom dodavanju
        }

    }

    public function deleteCategory($categoryId) {
        //$categoryId = $_GET['category_id'];
        $itemCategory = $this->model->getItemCategory($categoryId);
        if ($itemCategory){
            header('Location: ' . ADMIN_URL . 'products/category?error=5'); //poruka da brisanje nije moguce dok kategrija ima proizvode
            die();
        }
        $result = $this->model->deleteCategory($categoryId);
        if ($result){
        header('Location: ' . ADMIN_URL . 'products/category?error=3'); //poruka o uspesnom brisanju
        } else{
             header('Location: ' . ADMIN_URL . 'products/category?error=4');//poruka o neuspesnom brisanju
        }
    }

    //metoda za prikaz izabrane kategprije
     public function selectedCategory($categoryId) {
        $this->view->activeNavigation = 'kategorije';
        $category = $this->model->getCategory($categoryId);//izvlacenje podataka o izabranoj  kategoriji
        $this->view->category = $category;
        $this->view->render('products/izabrana_kategorija.php'); //prikaz stranice sa izabranom kategorijom i formom za imenu
    }

    //metoda za izmenu kategorije
    public function changeCategory($categoryId) {
        $name = $_POST['name'];
        $stat=$_POST['active'];
        $update = array($categoryId,$name,$stat);
        $result = $this->model->updateCategory($update);
        if ($result){
        header('Location: ' . ADMIN_URL . 'products/selectedCategory/' . $categoryId . '?error=1');
        } else{
             header('Location: ' . ADMIN_URL . 'products/selectedCategory/' . $categoryId . '?error=2');
        }
    }
    public function subcategory(){
        $this->view->activeNavigation = 'podkategorije';
        $categories = $this->model->getAdminCategories(); //poziva metodu iz modula koja vraca podatke o kategorijama
        $this->view->categories = $categories; //pravi svojstvo kome dodeljuje podatke o kategorijama
        $subCategory = $this->model->getAdminSubCategories();
        $this->view->podkategorije=$subCategory;
        $this->view->render('products/podkategorije.php');

    }
    public function addSubcategory() {
        $addName = $_POST['name'];
        $active=$_POST['active'];
        $categoryId=$_POST['fk_category_id'];

        $checkSubName = $this->model->checkSubCatName($addName);

        if ($checkSubName){
            header('Location:' . ADMIN_URL . 'products/subcategory?msg=5'); //5 - podkategorija sa tim nazivom vec postoji
            die();
        }

        $result = $this->model->addSubCategory($addName,$active,$categoryId); //poziva metodu modula koja dodaje kategoriju
        if ($result){
        header('Location: ' . ADMIN_URL . 'products/subcategory?error=1'); //vraca poruku o uspesnom dodavanju kategorije
        } else{
             header('Location: ' . ADMIN_URL . 'products/subcategory?error=2'); //poruka o neuspesnom dodavanju
        }

    }
    public function deleteSubcategory($subCategoryId) {
        //$categoryId = $_GET['category_id'];
        $subCategoryItem = $this->model->getSubCategoryItem($subCategoryId);
        if ($subCategoryItem){
            header('Location: ' . ADMIN_URL . 'products/subcategory?error=5'); //poruka da brisanje nije moguce dok kategrija ima proizvode
            die();
        }
        $result = $this->model->deleteSubCategory($subCategoryId);
        if ($result){
        header('Location: ' . ADMIN_URL . 'products/subcategory?error=3'); //poruka o uspesnom brisanju
        } else{
             header('Location: ' . ADMIN_URL . 'products/subcategory?error=4');//poruka o neuspesnom brisanju
        }
    }
    //metoda za prikaz izabrane kategprije
     public function selectedSubcategory($subCategoryId) {
        $this->view->activeNavigation = 'podkategorije';
        $subCategory = $this->model->getSubCategory($subCategoryId);//izvlacenje podataka o izabranoj  kategoriji
        $this->view->subCategory = $subCategory;
        $category = $this->model->getAdminCategories();
        $this->view->category = $category;
        $this->view->render('products/izabrana_podkategorija.php'); //prikaz stranice sa izabranom kategorijom i formom za imenu
    }

    //metoda za izmenu kategorije
    public function changeSubcategory($subCategoryId) {
        $subname = $_POST['name'];
        $subStatus= $_POST['active'];
        $subCat= $_POST['fk_category_id'];
        $updateSub = array($subCategoryId,$subname,$subStatus,$subCat);
        $result = $this->model->updateSubCategory($updateSub);
        if ($result){
        header('Location: ' . ADMIN_URL . 'products/selectedSubcategory/' . $subCategoryId . '?error=1');
        } else{
             header('Location: ' . ADMIN_URL . 'products/selectedSubcategory/' . $subCategoryId . '?error=2');
        }
    }

    /***************************************************************************
    2. PROIZVODI
    ***************************************************************************/
    public function index(){
        $this->view->activeNavigation = 'proizvodi';
        $categories=$this->model->getAdminCategories();
        $this->view->kategorije=$categories;
        $search = !empty($_GET['pretraga']) ? $_GET['pretraga'] : '';
        $this->view->searchParam = !empty($search) ? '&pretraga=' . $search : '';
        $this->view->search = $search;

        $itemsPerPage = 10;
        $page = 1;
        if (!empty ($_GET['page']) && $_GET['page']>1) {
            $page=$_GET['page'];
        }
        $offset = ($page-1)*$itemsPerPage;
        $limit = $itemsPerPage;
        $itemsCount = $this->model->countItems(0,0,$search);
        $pagesCount=ceil ($itemsCount/$itemsPerPage);
        $this->view->pagesCount=$pagesCount;
        $this->view->currentPage=$page;
        $this->view->paginationUrl = ADMIN_URL . 'products';  //отвечает за поиск

        $items = $this->model->getItems(0,0,$offset,$limit,$search);
        $this->view->items = $items;
        $subCategories=$this->model->getAdminSubCategories();
        $this->view->podkategorije=$subCategories;
        $this->view->render('products/index.php');
    }
    public function newProduct() {
        $this->view->activeNavigation = 'proizvodi';

        $categories = $this->model->getAdminCategories(); //vraca kategorije
        $this->view->categories = $categories;
        $subCategories=$this->model->getAdminSubCategories();
        $this->view->podkategorije=$subCategories;
        $this->view->render('products/novi_proizvod.php'); // prikazuje stranicu za dodavanje novog proizvoda
    }

    //upis novog proizvoda u bazu
    public function addProduct() {
        $item['title'] = $_POST['title'];
        $item['description'] = $_POST['description'];
        $item['price'] = $_POST['price'];
        $item['fk_category_id'] = $_POST['fk_category_id'];
        $item['fk_sub_category_id'] = $_POST['fk_sub_category_id'];
        $item['image'] = !empty($_FILES['image']['name']) ? $_FILES['image']['name'] : '';

        $itemId = $this->model->addItem($item); //upisuje proizvod u bazu i vraca njegov Id koji je potreban  za cuvanje slika proizvoda

        //Ako dodajemo sliku, pravi folder ako ne postoji i cuva slike odgovarajucih velicina
        if (!empty($_FILES['image']['tmp_name']) && $_FILES['image']['error'] == 0 && $_FILES['image']['size'] > 0) {
            require_once LIBS . 'PHPThumb/ThumbLib.inc.php';
            $imageFolder = BASE_PATH.'images/products/' . $itemId . '/';
            $imageFile = $_FILES['image']['name'];

            if (!is_dir($imageFolder)) {
                mkdir($imageFolder);   //pravi folder ako vec ne postoji
            }

            foreach ($this->thumbs as $thumb) {
                $newImageFile = $thumb['width'] . 'x' . $thumb['height'] . '_' . $imageFile;
                $phpThumb = PhpThumbFactory::create($_FILES['image']['tmp_name']);
                $phpThumb->resize($thumb['width'], $thumb['height'])->save($imageFolder . $newImageFile); //cuva sliku
            }

        }

        if($itemId){
            header('Location: ' . ADMIN_URL . 'products?poruka=1');
        } else {
            header('Location: ' . ADMIN_URL . 'products?poruka=2');
        }
    }

    public function deleteProduct() {
        $itemId = $_GET['item_id'];
        $result = $this->model->deleteItem($itemId); //poziva metodu iz modula za brisanje proizvoda

        if($result){
            header('Location: ' . ADMIN_URL . 'products?poruka=3');
        } else {
            header('Location: ' . ADMIN_URL . 'products?poruka=4');
        }
    }

    public function updateProduct($itemId) {
        $this->view->activeNavigation = 'proizvodi';

        $item = $this->model->getItem($itemId);  //poziva metodu koja vraca podatke o proizvodu
        $this->view->item = $item;

        $categories = $this->model->getAdminCategories(); //vraca podatke o kategorijama
        $this->view->categories = $categories;
        $subCategories = $this->model->getAdminSubCategories();
        $this->view->podkategorije=$subCategories;
        $this->view->render('products/azuriranje_proizvoda.php');
    }

    public function changeProduct() {
        $item['item_id'] = $_POST['item_id'];
        $item['title'] = $_POST['title'];
        $item['description'] = $_POST['description'];
        $item['price'] = $_POST['price'];
        $item['fk_category_id'] = $_POST['fk_category_id'];
        $item['fk_sub_category_id'] = $_POST['fk_sub_category_id'];
        $item['active'] = $_POST['active'];
        $item['image'] = !empty($_FILES['image']['name']) ? $_FILES['image']['name'] : '';

        $result = $this->model->updateItem($item); //poziva metodu  iz modula koja azurira proizvod

        //Ako menjamo sliku
        if (!empty($_FILES['image']['tmp_name']) && $_FILES['image']['error'] == 0 && $_FILES['image']['size'] > 0) {
            require_once LIBS . 'PHPThumb/ThumbLib.inc.php';
            $imageFolder = BASE_PATH.'images/' . $item['item_id'] . '/';
            $imageFile = $_FILES['image']['name'];
            //ako ne postoji folder pravi ga
            if (!is_dir($imageFolder)) {
                mkdir($imageFolder);
            }
            //ako postoji folder brise se sve iz njega da bi dosle nove slike
            if (is_dir($imageFolder)) {
                array_map('unlink', glob($imageFolder . '*'));
            }

            foreach ($this->thumbs as $thumb) {
                $newImageFile = $thumb['width'] . 'x' . $thumb['height'] . '_' . $imageFile;
                $phpThumb = PhpThumbFactory::create($_FILES['image']['tmp_name']);
                $phpThumb->resize($thumb['width'], $thumb['height'])->save($imageFolder . $newImageFile);
            }

        }

        if($result){
            header('Location: ' . ADMIN_URL . 'products?poruka=5');
        } else {
            header('Location: ' . ADMIN_URL . 'products?poruka=6');
        }
    }


}