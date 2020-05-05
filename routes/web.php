<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::get('/','user\WelcomeController@index')->name('home');
Route::get('/home','user\WelcomeController@index')->name('home2');
Route::get('/kontak','user\WelcomeController@kontak')->name('kontak');
Route::get('/produk','user\ProdukController@index')->name('user.produk');
Route::get('/produk/cari','user\ProdukController@cari')->name('user.produk.cari');
Route::get('/kategori/{id}','KategoriController@produkByKategori')->name('user.kategori');
Route::get('/produk/{id}','user\ProdukController@detail')->name('user.produk.detail');

Route::get('/pelanggan',function(){
    return 'Pelanggan';
});

Route::group(['middleware' => ['auth','checkRole:admin']],function(){    
    Route::get('/admin','DashboardController@index')->name('admin.dashboard');
    Route::get('/pengaturan/alamat','admin\PengaturanController@aturalamat')->name('admin.pengaturan.alamat');
    Route::get('/pengaturan/ubahalamat/{id}','admin\PengaturanController@ubahalamat')->name('admin.pengaturan.ubahalamat');
    Route::get('/pengaturan/alamat/getcity/{id}','admin\PengaturanController@getCity')->name('admin.pengaturan.getCity');
    Route::post('pengaturan/simpanalamat','admin\PengaturanController@simpanalamat')->name('admin.pengaturan.simpanalamat');
    Route::post('pengaturan/updatealamat/{id}','admin\PengaturanController@updatealamat')->name('admin.pengaturan.updatealamat');

    Route::get('/admin/categories','admin\CategoriesController@index')->name('admin.categories');
    Route::get('/admin/categories/tambah','admin\CategoriesController@tambah')->name('admin.categories.tambah');
    Route::post('/admin/categories/store','admin\CategoriesController@store')->name('admin.categories.store');
    Route::post('/admin/categories/update/{id}','admin\CategoriesController@update')->name('admin.categories.update');
    Route::get('/admin/categories/edit/{id}','admin\CategoriesController@edit')->name('admin.categories.edit');
    Route::get('/admin/categories/delete/{id}','admin\CategoriesController@delete')->name('admin.categories.delete');

    Route::get('/admin/product','admin\ProductController@index')->name('admin.product');
    Route::get('/admin/product/tambah','admin\ProductController@tambah')->name('admin.product.tambah');
    Route::post('/admin/product/store','admin\ProductController@store')->name('admin.product.store');
    Route::get('/admin/product/edit/{id}','admin\ProductController@edit')->name('admin.product.edit');
    Route::get('/admin/product/delete/{id}','admin\ProductController@delete')->name('admin.product.delete');
    Route::post('/admin/product/update/{id}','admin\ProductController@update')->name('admin.product.update');

    Route::get('/admin/transaksi','admin\TransaksiController@index')->name('admin.transaksi');
    Route::get('/admin/transaksi/perludicek','admin\TransaksiController@perludicek')->name('admin.transaksi.perludicek');
    Route::get('/admin/transaksi/perludikirim','admin\TransaksiController@perludikirim')->name('admin.transaksi.perludikirim');
    Route::get('/admin/transaksi/dikirim','admin\TransaksiController@dikirim')->name('admin.transaksi.dikirim');
    Route::get('/admin/transaksi/detail/{id}','admin\TransaksiController@detail')->name('admin.transaksi.detail');
    Route::get('/admin/transaksi/konfirmasi/{id}','admin\TransaksiController@konfirmasi')->name('admin.transaksi.konfirmasi');
    Route::post('/admin/transaksi/inputresi/{id}','admin\TransaksiController@inputresi')->name('admin.transaksi.inputresi');
    Route::get('/admin/transaksi/selesai','admin\TransaksiController@selesai')->name('admin.transaksi.selesai');
    Route::get('/admin/transaksi/dibatalkan','admin\TransaksiController@dibatalkan')->name('admin.transaksi.dibatalkan');

    Route::get('/admin/rekening','admin\RekeningController@index')->name('admin.rekening');
    Route::get('/admin/rekening/edit/{id}','admin\RekeningController@edit')->name('admin.rekening.edit');
    Route::get('/admin/rekening/tambah','admin\RekeningController@tambah')->name('admin.rekening.tambah');
    Route::post('/admin/rekening/store','admin\RekeningController@store')->name('admin.rekening.store');
    Route::get('/admin/rekening/delete/{id}','admin\RekeningController@delete')->name('admin.rekening.delete');
    Route::post('/admin/rekening/update/{id}','admin\RekeningController@update')->name('admin.rekening.update');

    Route::get('/admin/pelanggan','admin\PelangganController@index')->name('admin.pelanggan');
});

Route::group(['middleware' => ['auth','checkRole:customer']],function(){
    Route::post('/keranjang/simpan','user\KeranjangController@simpan')->name('user.keranjang.simpan');
    Route::get('/keranjang','user\KeranjangController@index')->name('user.keranjang');
    Route::post('/keranjang/update','user\KeranjangController@update')->name('user.keranjang.update');
    Route::get('/keranjang/delete/{id}','user\KeranjangController@delete')->name('user.keranjang.delete');
    Route::get('/alamat','user\AlamatController@index')->name('user.alamat');
    Route::get('/getcity/{id}','user\AlamatController@getCity')->name('user.alamat.getCity');
    Route::post('/alamat/simpan','user\AlamatController@simpan')->name('user.alamat.simpan');
    Route::post('/alamat/update/{id}','user\AlamatController@update')->name('user.alamat.update');
    Route::get('/alamat/ubah/{id}','user\AlamatController@ubah')->name('user.alamat.ubah');
    Route::get('/checkout','user\CheckoutController@index')->name('user.checkout');
    Route::post('/order/simpan','user\OrderController@simpan')->name('user.order.simpan');
    Route::get('/order/sukses','user\OrderController@sukses')->name('user.order.sukses');
    Route::get('/order','user\OrderController@index')->name('user.order');
    Route::get('/order/detail/{id}','user\OrderController@detail')->name('user.order.detail');
    Route::get('/order/pesananditerima/{id}','user\OrderController@pesananditerima')->name('user.order.pesananditerima');
    Route::get('/order/pesanandibatalkan/{id}','user\OrderController@pesanandibatalkan')->name('user.order.pesanandibatalkan');
    Route::get('/order/pembayaran/{id}','user\OrderController@pembayaran')->name('user.order.pembayaran');
    Route::post('/order/kirimbukti/{id}','user\OrderController@kirimbukti')->name('user.order.kirimbukti');
});

Route::get('/ongkir', 'OngkirController@index');
Route::get('/ongkir/province/{id}/cities', 'OngkirController@getCities');
// Route::get('/submit', 'OngkirController@submit')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
