<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://www.pavilionweb.com/wp-content/uploads/2017/03/man-300x300.png" alt="User Image" width="48px" height="48px">
        <div>
            <p class="app-sidebar__user-name"><?php echo $ykadi;?></p>
            <p class="app-sidebar__user-designation">Yönetici</p>
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item active" href="index.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Ana Sayfa</span></a></li>

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-list"></i><span class="app-menu__label">Kategoriler</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?php echo $yonetimUrl;?>/kategoriler.php"><i class="icon fa fa-circle-o"></i> Kategori Listesi</a></li>
                <li><a class="treeview-item" href=""><i class="icon fa fa-circle-o"></i> Yeni Kategori Ekle</a></li>

            </ul>
        </li>

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Yazılar</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href=""><i class="icon fa fa-circle-o"></i> Yazı Listesi</a></li>
                <li><a class="treeview-item" href=""><i class="icon fa fa-circle-o"></i> Yeni Yazı Ekle</a></li>

            </ul>
        </li>

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-comment"></i><span class="app-menu__label">Yorumlar</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href=""><i class="icon fa fa-circle-o"></i> Onaylı Yorumlar</a></li>
                <li><a class="treeview-item" href=""><i class="icon fa fa-circle-o"></i> Onay Bekleyen Yorumlar</a></li>

            </ul>
        </li>

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-envelope"></i><span class="app-menu__label">Mesajlar</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href=""><i class="icon fa fa-circle-o"></i> Okunmuş Mesajlar</a></li>
                <li><a class="treeview-item" href=""><i class="icon fa fa-circle-o"></i> Yeni Mesajlar</a></li>

            </ul>
        </li>

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-facebook-square"></i><span class="app-menu__label">Sosyal Medya</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href=""><i class="icon fa fa-circle-o"></i> Sosyal Medya Listesi</a></li>
                <li><a class="treeview-item" href=""><i class="icon fa fa-circle-o"></i> Yeni Sosyal Medya Ekle</a></li>

            </ul>
        </li>

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Aboneler</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href=""><i class="icon fa fa-circle-o"></i> Abone Listesi</a></li>

            </ul>
        </li>

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cog"></i><span class="app-menu__label">Ayarlar</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href=""><i class="icon fa fa-circle-o"></i> Genel Ayarlar</a></li>
                <li><a class="treeview-item" href=""><i class="icon fa fa-circle-o"></i> İletişim Ayarları</a></li>
                <li><a class="treeview-item" href=""><i class="icon fa fa-circle-o"></i> Logo Ayarları</a></li>
                <li><a class="treeview-item" href=""><i class="icon fa fa-circle-o"></i> Favicon Ayarları</a></li>
                <li><a class="treeview-item" href=""><i class="icon fa fa-circle-o"></i> Doğrulama Ayarları</a></li>

            </ul>
        </li>


    </ul>
</aside>