  <!--  =========== Código menú estatico ============ -->

  <!-- Left side column. contains the logo and sidebar -->
  <!-- <aside class="main-sidebar"> -->

    <!-- sidebar: style can be found in sidebar.less -->
   <!--  <section class="sidebar"> -->

      <!-- Sidebar user panel (optional) -->
     <!--  <div class="user-panel">
        <div class="pull-left image">
          <img src="views/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p> -->
          <!-- Status -->
   <!--        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div> -->

      <!-- search form (Optional) -->
   <!--    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form> -->
      <!-- /.search form -->

      <!-- Sidebar Menu -->
    <!--   <ul class="sidebar-menu" data-widget="tree">
        <li class="header">HEADER</li> -->
        <!-- Optionally, you can add icons to the links -->
<!--         <li class="active"><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li>
        <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li>
      </ul> -->
      <!-- /.sidebar-menu -->
  <!--   </section> -->
    <!-- /.sidebar -->
<!--   </aside> -->
<!--  =========== Fin código menú estatico ============ -->


<!--  =========== Código para hacer el menú dimanico ============ -->
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="views/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['name_user']; ?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form" hidden="">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->

<?php
/*  require_once("class/pdo_db.php");
  require_once("class/class_redireccion_web.php");
  $db_conn = new ConectPDO();*/

  $id_user = $_SESSION['id_user'];
  $id_menu = $_SESSION['id_menu'];
  $arramymenus = array();
  $refs = array();
  $list = array();

  // recupero los menus a los que tenemos permisos
/*  $sql="SELECT * from t_user where id_user=:id_user";
  $mipdo->bind('id_user', $id_user);
  $row_permisos = $mipdo->execute($sql);
  $arramymenus = explode(",", $row_permisos[0]['id_menu']) ; */

   $arramymenus = explode(",", $id_menu) ; 
  // Fin de los permisos del menú


   $sql="SELECT id_menu as menu_item_id, parent_id as menu_parent_id, title as menu_item_name,concat('/escandallo/?',url)as url,menu_order,icon FROM dynamic_menu ORDER BY menu_order";
   $stmt = $db_conn->db->prepare($sql);
   $stmt->execute();
   $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


    foreach ($rows as $data ) 
    {

       if(in_array($data['menu_item_id'], $arramymenus)) {  // comparamos con el id del menú o submenú

        $thisref = &$refs[ $data['menu_item_id'] ];
        $thisref['menu_parent_id'] = $data['menu_parent_id'];
        $thisref['menu_item_name'] = $data['menu_item_name'];
        $thisref['url'] = $data['url'];
        $thisref['icon'] = $data['icon'];

        if ($data['menu_parent_id'] == 0)
        {
          $list[ $data['menu_item_id'] ] = &$thisref;
        }
        else
        {
          $refs[ $data['menu_parent_id'] ]['children'][ $data['menu_item_id'] ] = &$thisref;
        }

      } // if in_array


    }
    // */foreach




    function create_list( $arr ,$urutan)
    {
    if($urutan==0){
           $html = "\n<ul class='sidebar-menu tree' data-widget='tree'>\n";
           $html .= "\n<li class='header'>MENÚ NAVEGACIÓN</li>\n";
    }else
    {
       $html = "\n<ul class='treeview-menu'>\n";
    }

        foreach ($arr as $key=>$v)
        {
            if (array_key_exists('children', $v))
            {
                $html .= "<li class='treeview'>\n";
                $html .= '<a href="#">
                                <i class="'.$v['icon'].'"></i>
                                <span >'.$v['menu_item_name'].'</span>
                                <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>';

                $html .= create_list($v['children'],1);
                $html .= "</li>\n";
            }
            else{
          $html .= '<li><a href="'.redireccion_web::getUrlEncode($v['url']).'">';
          if($urutan==0)
          {
            $html .=  '<i class="'.$v['icon'].'"></i>';
          }
          if($urutan==1)
          {
            $html .=  '<i class="fa fa-circle-o"></i>';
          }
          $html .= "<span>".$v['menu_item_name']."</span></a></li>\n";}
        }
        // */foreach
        $html .= "</ul>\n";
        return $html;
    }
    echo create_list( $list,0 );
?>
                </section>
            </aside>
<!--  =========== Fin código para hacer el menú dimanico ============ -->
