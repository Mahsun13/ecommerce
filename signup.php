 <?php
  $customer = New customer;
  $res = $customer->single_customer($_SESSION['CUSID']);
 
  ?>  
<h3>Ваш профиль</h3>
  <form  class="form-horizontal span6" action="customer/controller.php?action=edit" onsubmit="return personalInfo();" name="personal" method="POST" enctype="multipart/form-data"> 
          <div class="row">
             <div class="col-lg-6">
            <div class="form-group">
              <div class="col-md-12">
                <label class="col-md-4 control-label" for=
                "FNAME">Имя:</label>
                  <div class="col-md-8">
                   <input class="form-control input-sm" id="FNAME" name="FNAME" placeholder=
                      "First Name" type="text" value="<?php echo $res->FNAME; ?>">
                </div>
              </div>
            </div>
           </div>   
           
           <div class="col-lg-6"> 
            <div class="form-group">
              <div class="col-md-12">
                <label class="col-md-4 control-label" for=
                "LNAME">Фамилия:</label>

                <div class="col-md-8">
                   <input class="form-control input-sm" id="LNAME" name="LNAME" placeholder=
                      "Last Name" type="text" value="<?php echo $res->LNAME; ?>">
                </div>
              </div>
            </div>
           </div>   

         
            <div class="col-lg-6">
             
             <div class="form-group">
              <div class="col-md-12">
                <label class="col-md-4 control-label" for=
                "CITYADD">Город/Регион:</label>

                <div class="col-md-8">
                   <input class="form-control input-sm" id="CITYADD" name="CITYADD" placeholder=
                      "Город/Регион адрес" type="text" value="<?php echo $res->CITYADD; ?>">
                </div>
              </div>
            </div>

           </div>  


       
  

            <div class="col-lg-6"> 
                <div class="form-group">
                <div class="col-md-12">
                  <label class="col-md-4 control-label" for=
                  "PHONE">Контакт#:</label>

                  <div class="col-md-8">
                     <input class="form-control input-sm" id="PHONE" name="PHONE" placeholder=
                        "Тел номер" type="text" value="<?php echo $res->PHONE; ?>">
                  </div>
                </div>
              </div> 
           </div> 

             <div class="col-lg-6">
              <div class="form-group">
                <div class="col-md-12">
                  <label class="col-md-4 control-label" for=
                  "CUSUNAME">Логин:</label>

                  <div class="col-md-8">
                     <input class="form-control input-sm" id="CUSUNAME" name="CUSUNAME" placeholder=
                        "Логин" type="text" value="<?php echo $res->CUSUNAME; ?>">
                  </div>
                </div>
              </div> 
           </div>  
     <div class="col-lg-6">
          <div class="form-group">
            <div class="col-md-12">
              <label class="col-md-4 control-label" for=
              "GENDER">Пол:</label>

              <div class="col-lg-8"> 
                <input  id="GENDER" name="GENDER"  type="radio" <?php echo ($res->GENDER=='Male') ? 'CHECKED' : '' ;  ?>   value="Male" /><b> Мужской </b>
                    <input   id="GENDER"   name="GENDER"   type="radio" <?php echo ($res->GENDER=='Female') ? 'CHECKED' : '' ; ?> value="Female" /> <b> Женский </b>
              </div>
            </div>
          </div>
          </div>
      
          </div>
          
           

          <div class="col-lg-6"> 
              <div class="form-group">
                <div class="col-md-12">
                   <label class="col-md-4" align = "right"for=
                  "btn"></label>
                  <div class="col-md-8">
                    <input type="submit"  name="save"  value="Save"  class="submit btn btn-primary btn-lg"  />
                      
                </div>
              </div>
            </div>
         </div>     
  </form>   
  
   
                
 
                  

                               
                





 
              








                   
        
        </form>