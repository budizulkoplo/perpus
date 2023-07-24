<?php
                include "config/koneksi.php";
                $sql = mysql_query("SELECT * FROM m_menu where submenu='0' and aktif='Y' and `level` like '%$_SESSION[level]%' ORDER BY idmenu ASC");
                if(mysql_num_rows($sql) != 0){

                while($row = mysql_fetch_array($sql)){
                $parentid = $row["parentid"];
                $sql2 = mysql_query("SELECT * FROM m_menu where submenu='1' and aktif='Y' and `level` like '%$_SESSION[level]%' and parentid='$parentid'");

                echo "<li class='$row[class]'><a href='$row[link]'><i class='$row[icon]'></i> <span class='nav-label'>$row[namamenu]</span> $row[add]</a>";
                                while($row2 = mysql_fetch_array($sql2)){
                echo "<ul class='nav nav-second-level'>";

                echo "
                <li class='$row2[class]'><a href='$row2[link]'><i class='$row2[icon]'></i> $row2[namamenu]</a></li>";
                
                echo "</ul>";}
                echo "</li>";
                }}

                ?>