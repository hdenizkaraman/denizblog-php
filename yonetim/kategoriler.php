<?php require_once 'inc/ust.php'; ?>
    <!-- Sidebar menu-->
<?php require_once 'inc/sol.php'; ?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Kategoriler</h1>
          <p>Kategori Listesi</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Kategoriler</li>
          <li class="breadcrumb-item active"><a href="#">Kategori Listesi</a></li>
        </ul>
      </div>
      <div class="row">

        <div class="clearfix"></div>
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Kategori Listesi</h3>
            <div class="table-responsive table-hover">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>KATEGORİ ADI</th>
                    <th>İŞLEMLER</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>PHP</td>
                      <td><a href=""><i class="fa fa-edit"></i></a> | <a onclick="return confirm('Kategori silindiği zaman bu kategoriye ait tüm konular pasif duruma gelecektir onaylıyor musunuz ?');" href=""><i class="fa fa-eraser"></i></a></td>
                  </tr>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>
<?php require_once 'inc/alt.php'; ?>