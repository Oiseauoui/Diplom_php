<?php

class Products_Controller extends Controller {

    public function index () {

        $categories=$this->model->getCategories();
        $this->view->kategorije=$categories;

        $search = !empty($_GET['pretraga']) ? $_GET['pretraga'] : '';
        $this->view->searchParam = !empty($search) ? '&pretraga=' . $search : '';
        $this->view->search = $search;

        $itemsPerPage = 12;
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
        $this->view->paginationUrl = URL . 'products';


        $items = $this->model->getItems(0,0,$offset,$limit,$search);
        $this->view->items = $items;

        $subCategories=$this->model->getSubCategories();
        $this->view->podkategorije=$subCategories;

        $this->view->render('products/index.php');
    }
    public function category () {


        $categoryId= !empty ($_GET['cid']) ? $_GET['cid'] : '';
        $categories=$this->model->getCategories();
        $this->view->CategoryId = $categoryId;
        $this->view->kategorije=$categories;

        $search = !empty($_GET['pretraga']) ? $_GET['pretraga'] : '';
        $this->view->searchParam = !empty($search) ? '&pretraga=' . $search : '';
        $this->view->search = $search;

        $subCatId= !empty ($_GET['scid']) ? $_GET['scid'] : '';
        $subCategories=$this->model->getSubCategories();
        $this->view->podkategorije=$subCategories;
        $this->view->subCatId=$subCatId;

        $itemsPerPage = 12;
        $page = 1;
        if (!empty ($_GET['page']) && $_GET['page']>1) {
            $page=$_GET['page'];
        }
        $offset = ($page-1)*$itemsPerPage;
        $limit = $itemsPerPage;
        $itemsCount = $this->model->countItems($categoryId,$subCatId,$search);
        $pagesCount= ceil($itemsCount/$itemsPerPage);
        $this->view->pagesCount=$pagesCount;
        $this->view->currentPage=$page;
        $this->view->paginationUrl =  URL .'products/category?cid='. $categoryId .'&scid='. $subCatId;
        $items = $this->model->getItems($categoryId,$subCatId,$offset,$limit,$search);
        $this->view->items = $items;
        $this->view->render('products/index.php');
    }

    public function product ($itemId,$itemSubId='') {
        $categories = $this->model->getCategories();
        $this->view->kategorije = $categories;
		
		  $search = !empty($_GET['pretraga']) ? $_GET['pretraga'] : '';
        $this->view->searchParam = !empty($search) ? '&pretraga=' . $search : '';
        $this->view->search = $search;

        $subCategories=$this->model->getSubCategories();
        $this->view->podkategorije=$subCategories;

        $item = $this->model->getItem($itemId); // poziv metode iz modela koja vadi podatke o proizvodu
        $this->view->item = $item;

        $itemImages = $this->model->getItemImages($itemSubId);
        $this->view->itemImages=$itemImages;

        $this->view->paginationUrl = URL . 'products';

        $this->view->render('products/proizvod.php');
    }

    public function addCart() {
        // metoda koja se poziva pri dodavanju proizvoda u korpu
        // parametar metode je id proizvoda koji se dodaje u korpu

        // metoda koja se poziva pri dodavanju proizvoda u korpu
        // parametar metode je id proizvoda koji se dodaje u korpu


            $itemId=$_GET['itemId'];

            $item = $this->model->getItem($itemId); // vadimo podatke o proizvodu koji ubacujemo u korpu
            $subId= $item['fk_sub_category_id'];
            if(!empty($_GET['kolicina'])){
            $kolicina=$_GET['kolicina'];
            $_SESSION['korpa'][] = array(
                'title'=>$item['title'],'image'=>$item['images']['160x160'],'category'=>$item['category'],'price'=>$item['price'],'kolicina'=>$kolicina,'item_id'=>$item['item_id'],
            ); // u nizu sesije pravimo niz korpa koji nam cuva podatke o proizvodima u korpi



            header('Location: ' . URL . 'products/product/' . $itemId . '/' . $subId);} // redirekcija na selektovani proizvod
            else {
             header('Location: ' . URL . 'products/product/' . $itemId . '/' . $subId .'?error=neuspesno');
            }
    }
    public function cart() {
      // metoda koja se poziva kada se klikne na korpu

        // ako korpa nije prazna brojimo koliko proizvoda ima u njoj
        if(!empty($_SESSION['korpa'])){
            $itemsCount = count($_SESSION['korpa']);
            // sve elemente niza korpa smestamo u promenljivu $items
            $items = $_SESSION['korpa'];
            // prosledjujemo te podatke templejtu
            $this->view->items = $items;
            $this->view->itemsCount = $itemsCount;
        }
        else {
            $this->view->itemsCount = 0;
        }

            $this->view->render('products/korpa.php');


		// exit();


    }

    public function order() {
        $id=$_GET['id'];
        $cena=$_GET['cena'];
        $broj=$_GET['broj'];

        // naruci je metoda koja se poziva prilikom kupovine

        //  prvo proveravamo da li je korisnik ulogovan (ulogovan je ako postoji element user_id u sesiji) i da li ima proizvoda u korpi
        if (!empty($_SESSION['user_id']) &&  !empty($_SESSION['korpa'])) {

            // za svaki proizvod iz korpe pozivamo metodu purchase iz modela koja upisuje u bazi id korisnika koji kupuje i id proizvoda koji je korisnik kupio

            $this->model->purchase($id, $broj, $cena);



            // nakon kupovine brisemo proizvode iz korpe
            unset($_SESSION['korpa']);

            header('Location: ' . URL . 'products/cart?msg=uspesno');
        }
    }


    public function deleteCart($rb) {
        // metoda koja brise odredjeni proizvod iz korpe

        $rb = empty($rb) ? 0 : $rb;
        unset($_SESSION['korpa'][$rb]);

        header('Location: ' . URL . 'products/cart');
        return true;
    }
}