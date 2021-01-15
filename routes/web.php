<?php

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

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => "auth"],function(){

Route::get('/', 'DashboardController@index');
Route::get('/dashboard', 'DashboardController@dash');

Route::get('/mahasiswa', 'MahasiswaController@index');
Route::get('mapelByJurusan/{id}', 'MahasiswaController@mapelByJurusan')->name('mapelByJurusan');
Route::get('/mahasiswa/api', 'MahasiswaController@api')->name('api');
Route::post('/students', 'MahasiswaController@create');
Route::get('/mahasiswa/show/{id}', 'MahasiswaController@show')->name('mahasiswa.show');
Route::patch('/mahasiswa/update/{id}', 'MahasiswaController@update')->name('mahasiswa.update');
Route::delete('/mahasiswa/destroy/{id}', 'MahasiswaController@destroy')->name('mahasiswa.destroy');

Route::post('/mahasiswa/api', 'RoleController@api')->name('api');
Route::post('storePermissions', 'RoleController@storePermissions')->name('store.permissions');
Route::get('{id}/getPermissions', 'RoleController@getPermissions')->name('getPermissions');
Route::delete('destroyPermission/{name}', 'RoleController@destroyPermission')->name('destroyPermission');
Route::get('addpermission/{id}', 'RoleController@permission')->name('addpermission');
Route::resource('role', 'RoleController');

Route::resource('permission', 'PermissionController');
Route::post('permission/api', 'PermissionController@api')->name('permission.api');

Route::resource('pengguna', 'PenggunaController');
Route::post('pengguna/api', 'PenggunaController@api')->name('pengguna.api');
Route::get('/pengguna/editpassword/{id}', 'PenggunaController@editpassword')->name('pengguna.editpassword');
Route::post('/pengguna/updatePassword/{id}', 'PenggunaController@updatePassword')->name('pengguna.updatePassword');


Route::resource('jurusan', 'JurusanController');
Route::post('jurusan/api', 'JurusanController@api')->name('jurusan.api');
Route::post('jurusan/tambah', 'JurusanController@tambah')->name('jurusan.tambah');
Route::get('listmatapelajaran/{id}','JurusanController@listPelajaran')->name('listmatapelajaran');




Route::resource('matapelajaran', 'MatapelajaranController');
Route::post('matapelajaran/api', 'MatapelajaranController@api')->name('matapelajaran.api');

Route::resource('jupel', 'JupelController');
Route::post('jupel/api', 'JupelController@api')->name('jupel.api');

Route::resource('sejarah', 'SejarahController');
Route::post('profile/api', 'SejarahController@api')->name('profile.api');

Route::resource('sambutan', 'SambutanController');
Route::post('sambutan/api', 'SambutanController@api')->name('sambutan.api');

Route::resource('visi', 'VmController');
Route::post('visi/api', 'VmController@api')->name('visi.api');

Route::resource('pendidik', 'PendidikController');
Route::post('pendidik/api', 'PendidikController@api')->name('pendidik.api');

Route::resource('berita', 'BeritaController');
Route::post('berita/api', 'BeritaController@api')->name('berita.api');

Route::resource('infosekolah', 'InfoController');
Route::post('infosekolah/api', 'infoController@api')->name('infosekolah.api');

Route::resource('gallery', 'GalleryController');
Route::post('gallery/api', 'GalleryController@api')->name('gallery.api');

Route::resource('pendaftaran', 'PendaftaranController');
Route::post('pendaftaran/api', 'PendaftaranController@api')->name('pendaftaran.api');

Route::resource('agenda', 'AgendaController');
Route::post('agenda/api', 'AgendaController@api')->name('agenda.api');

Route::resource('pengumuman', 'PengumumanController');
Route::post('pengumuman/api', 'PengumumanController@api')->name('pengumuman.api');

Route::resource('prestasi', 'PrestasiController');
Route::post('prestasi/api', 'PrestasiController@api')->name('prestasi.api');

Route::resource('daftarsiswa', 'DaftarsiswaController');
Route::post('daftarsiswa/api', 'DaftarsiswaController@api')->name('daftarsiswa.api');

});






