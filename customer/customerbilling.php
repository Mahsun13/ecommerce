  
<?php 
  if (!isset($_SESSION['CUSID'])){
      redirect("index.php");
     }

 
$query = "SELECT * FROM `tblsummary` s ,`tblcustomer` c 
    WHERE   s.`CUSTOMERID`=c.`CUSTOMERID` and ORDEREDNUM='".$_SESSION['ORDEREDNUM']."'";
    $mydb->setQuery($query);
    $cur = $mydb->loadSingleResult();

?>
  
 
    <table>
      <tr>
        <td align="center"> 
        <img src="<?php echo web_root; ?>images/bg2.jpg"  height="90px" style="-webkit-border-radius:5px; -moz-border-radius:5px;" alt="Image">
            </td>
        <td width="87%" align="center">
        <h3 >Самарканд СФ ТУИТ</h3> 
        </td>
      </tr>
    </table>
    
     
  <!--  <div class="modal-body">  -->
  <h5>Ваш заказ находится в процессе обработки. Пожалуйста, проверьте свой профиль на наличие уведомления о подтверждении.</h5>
 
<hr/> 
 <h4><strong>Информация о заказе</strong></h4>
    <table id="table" class="table">
      <thead>
        <tr>
          <th>ТОВАР</th>
          <th>ЦЕНА</th>
          <th>КОЛИЧЕСТВО</th>
          <th>СУММА</th>
          <th></th> 
        </tr>
        </thead>
        <tbody>
 
        <?php
         
          $query = "SELECT * 
              FROM  `tblproduct` p, tblcategory ct,  `tblcustomer` c,  `tblorder` o,  `tblsummary` s
              WHERE p.`CATEGID` = ct.`CATEGID` 
              AND p.`PROID` = o.`PROID` 
              AND o.`ORDEREDNUM` = s.`ORDEREDNUM` 
              AND s.`CUSTOMERID` = c.`CUSTOMERID` 
              AND o.`ORDEREDNUM`=".$_SESSION['ORDEREDNUM'];
              $mydb->setQuery($query);
              $cur = $mydb->loadResultList(); 
            foreach ($cur as $result) {
              echo '<tr>';  
              echo '<td>'. $result->PROMODEL . ' <br/>'. $result->PRONAME .' '. $result->CATEGORIES. ' <br/>' .$result->PRODESC.'</td>';
              echo '<td> sum '. number_format($result->PROPRICE,2).' </td>';
              echo '<td align="center" >'. $result->ORDEREDQTY.'</td>';
              ?>
               <td> sum <output><?php echo  number_format($result->ORDEREDPRICE,2); ?></output></td> 
              <?php
              
              echo '</tr>';
         
        }
        ?> 
      </tbody>
    <tfoot >
    <?php 
         $query = "SELECT * FROM `tblsummary` s ,`tblcustomer` c 
        WHERE   s.`CUSTOMERID`=c.`CUSTOMERID` and ORDEREDNUM=".$_SESSION['ORDEREDNUM'];
    $mydb->setQuery($query);
    $cur = $mydb->loadSingleResult();

    if ($cur->PAYMENTMETHOD=="Cash on Delivery") {
      # code...
      $price = 25.00;
    }else{
      $price = 0.00;
    }


    $tot =   $cur->PAYMENT  - 25.00;
    ?>

   </tfoot>
       </table> <hr/>
    <div class="row">
        <div class="col-md-6 pull-left">
         <div>Дата закза : <?php echo date_format(date_create($cur->ORDEREDDATE),"M/d/Y h:i:s"); ?></div> 
          <div>Тип оплаты : <?php echo $cur->PAYMENTMETHOD; ?></div>

        </div>
        <div class="col-md-6 pull-right">
          <p align="right">Итоговая цена : UZS <?php echo number_format($tot,2);?></p>
          <p align="right"> Стоимость доставки: UZS <?php echo number_format($price,2); ?></p>
          <p align="right">Общая цена : UZS <?php echo number_format($cur->PAYMENT,2); ?></p>
        </div>
      </div>
     

<?php  unset($_SESSION['ORDEREDNUM']); ?>