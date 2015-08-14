<div class="row">
    <div class="col-sm-9 col-md-9 col-lg-9 job_ads1" align="center" style="">
        OUR PLEASURE TO HELP YOU FIND THE RIGHT JOB FOR YOU
    </div>
</div>
<br/>
<div class="row">
    
    <div class="col-sm-9 col-md-9 col-lg-9">
        <form action="<?= BASEURL. 'ajkk/searchFulltimeJob' ?>" method="post">
         <div class="col-sm-12 col-md-12 col-lg-12">
           <!-- <div class="col-sm-4 col-md-4 col-lg-4"> -->
                  <input id="search_data" type="text" name="search" class="searchjob_input" placeholder="job,skills,company,etc.."/>                     
            <!-- </div>  -->                       
            <!-- <div class="col-sm-4 col-md-4 col-lg-4"> -->
                <select placeholder="Location" class="styled-select" name="location">
                    <option value="">Any Location</option>
                    <optgroup label="NCR">
                      <option value="1">Metro Manila</option>
                      <option>Caloocan</option>
                      <option>Las Pinas</option>
                      <option>Makati</option>
                      <option>Malabon</option>
                      <option>Mandaluyong</option>
                      <option>Manila</option>
                      <option>Marikina</option>
                      <option>Muntinlupa</option>
                      <option>Navotas</option>
                      <option>Paranaque</option>
                      <option>Pasay</option>
                      <option>Pasig</option>                          
                      <option>Pateros</option>
                      <option>Quezon (QC)</option>
                      <option>San Juan</option>
                      <option>Pasig</option>
                      <option>Taguig</option>
                      <option>Valenzuela</option>                          
                      <option value="2">ALL NCR</option>
                    </optgroup>

                    <optgroup label="ARMM">
                      <option>Lanao Del Sur</option>
                      <option>Maguindanao</option>
                      <option>Shariff Kabunsuan</option>
                      <option>Sulu</option>
                      <option>Tawi Tawi</option>
                      <option value="3">ALL ARMM</option>
                    </optgroup>

                    <optgroup label="BICOL REGION">
                      <option>Albay</option>
                      <option>Camarines Norte</option>
                      <option>Camarines Sur</option>
                      <option>Catanduanes</option>
                      <option>Legazpi City</option>
                      <option>Masbate</option>
                      <option>Sorsogon</option>
                      <option value="4">ALL BICOL REGION</option>
                    </optgroup>                  

                    <optgroup label="CAR">
                      <option>Abra</option>
                      <option>Apayao</option>
                      <option>Baguio</option>
                      <option>Benguet</option>
                      <option>Ifugao</option>
                      <option>Kalinga</option>
                      <option>Mt. Province</option>
                      <option value="5">ALL CAR</option>
                    </optgroup>

                    <optgroup label="CAGAYAN VALLEY">
                      <option>Batanes</option>
                      <option>Isabela</option>
                      <option>Nueva Vizcaya</option>
                      <option>Quirino</option>
                      <option>Tuguegarao</option>
                      <option value="6">ALL CAGAYAN VALLEY</option>
                    </optgroup>

                    <optgroup label="CARAGA">
                      <option>Agusan Del Norte</option>
                      <option>Agusan Del Sur</option>
                      <option>Butuan City</option>
                      <option>Dinagat Islands</option>
                      <option>Surigao Del Norte</option>
                      <option>Surigao Del Sur</option>
                      <option value="7">ALL CARAGA</option>
                    </optgroup>

                    <optgroup label="CENTRAL LUZON">
                      <option>Angeles</option>
                      <option>Balanga</option>
                      <option>Bataan</option>
                      <option>Bulacan</option>                          
                      <option>Nueva Ecija</option>
                      <option>Olongapo</option>
                      <option>Pampanga</option>
                      <option>San Fernando Pampanga</option>
                      <option>Tarlac</option>
                      <option>Zambales</option>
                      <option value="8">ALL CENTRAL LUZON</option>
                    </optgroup>

                    <optgroup label="CENTRAL MINDANAO">
                      <option>Lanao Del Norte</option>
                      <option>North Cotabato</option>
                      <option value="9">ALL CENTRAL MINDANAO</option>
                    </optgroup>

                    <optgroup label="CENTRAL VISAYAS">
                      <option>Bohol</option>
                      <option>Cebu</option>
                      <option>Negros Oriental</option>
                      <option>Siquijor</option>
                      <option value="10">ALL CENTRAL VISAYAS</option>
                    </optgroup>
                    
                    <optgroup label="EASTERN VISAYAS">
                      <option>Biliran</option>
                      <option>Eastern Samar</option>
                      <option>Leyte</option>
                      <option>Nothern Samar</option>
                      <option>Southern Leyte</option>
                      <option>Tacloban</option>
                      <option>Western Samar</option>
                      <option value="11">ALL EASTERN VISAYAS</option>
                    </optgroup>
                    
                    <optgroup label="ILOCOS REGION">
                      <option>Dagupan</option>
                      <option>Ilocos Norte</option>
                      <option>Ilocos Sur</option>
                      <option>La Union</option>
                      <option>Pangasinan</option>
                      <option>San Fernando La Union</option>
                      <option>Urdaneta</option>
                      <option value="12">ALL ILOCOS REGION</option>
                    </optgroup>

                    <optgroup label="NOTHERN MINDANAO">
                      <option>Bukidnon</option>
                      <option>Cagayan De Oro City</option>
                      <option>Camuguin</option>
                      <option>Misamis Oriental</option>
                      <option value="13">ALL NOTHERN MINDANAO</option>                      
                    </optgroup>
                    
                    <optgroup label="SOUTHERN MINDANAO">
                      <option>Compostela Valley</option>
                      <option>Davao (del Norte)</option>
                      <option>Davao City</option>
                      <option>Davao Del Sur</option>                              
                      <option>Davao Oriental</option>  
                      <option>General Santos</option>  
                      <option>Saranggani</option>  
                      <option>South Cotabato</option>  
                      <option>Sultan Kudarat</option>  
                      <option value="14">ALL SOUTHERN MINDANAO</option>                        
                    </optgroup>
                    
                    <optgroup label="SOUTHERN TAGALOG">
                      <option>Aurora</option>
                      <option>Batangas</option>
                      <option>Cainta</option>
                      <option>Calamba</option>                              
                      <option>Calapan</option>  
                      <option>Cavite</option>  
                      <option>Laguna</option>  
                      <option>Marinduque</option>  
                      <option>Occidental Mindoro</option>  
                      <option>Palawan</option>                               
                      <option>Quezon</option>                   
                      <option>Rizal</option>
                      <option>Romblon</option>
                      <option>Sta. Rosa City</option>
                      <option value="15">ALL SOUTHERN TAGALOG</option>
                    </optgroup>
                    
                     <optgroup label="WESTERN MINDANAO">
                      <option>Basilan</option>
                      <option>Pagadian City</option>
                      <option>Zamboanga</option>
                      <option>Zamboanga Del Norte</option>                              
                      <option>Zamboanga Del Sur</option>  
                      <option>Zamboanga Del Sur</option>                           
                      <option value="16">ALL WESTERN MINDANAO</option>
                    </optgroup>
                    
                     <optgroup label="WESTERN VISAYAS">
                      <option>Aklan</option>
                      <option>Antique</option>
                      <option>Bacolod</option>
                      <option>Capiz</option>                              
                      <option>Guimaras</option>  
                      <option>IloIlo</option>    
                      <option>IloIlo City</option>   
                      <option>Negros Occidental</option>                         
                      <option value="17">ALL WESTERN VISAYAS</option>
                    </optgroup>
                    <optgroup label="Abroad (Asia)">
                      <option value="18" >China</option>
                      <option value="19" >Hongkong</option>
                      <option value="20" >India</option>
                      <option value="21" >Indonesia</option>
                      <option value="22" >Japan</option>
                      <option value="23" >Malaysia</option>
                      <option value="24" >Singapore</option>
                      <option value="25" >Thailand</option>
                      <option value="26" >Vietnam</option>
                    </optgroup>

                    <optgroup label="Abroad (Other)">
                      <option value="27" >Africa</option>
                      <option value="28" >Middle East</option>
                      <option value="29" >Australia & New Zealand</option>
                      <option value="30" >Europe</option>
                      <option value="31" >North America</option>
                      <option value="32" >South America</option>                                  
                    </optgroup>                                                          
                </select>                            
            <!-- </div>
            <div class="col-sm-2 col-md-5 col-lg-2"> -->
                <input type="submit" name="submit" id="submitbtn" value="SEARCH">
            <!-- </div> -->
            <br/><br/>
         </div>
        </form>

    </div>
    <?php if (!$this->authentication->isLoggedIn()){ ?>
      <div class="col-sm-2 col-md-2 col-lg-2" style="display:inline;">
          <ul>
              <li><a href="<?= BASEURL.'ajkk/login/member'?>">APPLICANT</a></li>
              <li><a href="<?= BASEURL.'ajkk/login/employer'?>">EMPLOYER</a></li>
          </ul>
      </div>
    <?php } ?>
    <div class="col-sm-9 col-md-9 col-lg-9" style="padding-right: 0;">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php $cnt=0;
                if (!empty($homemainbanner)){
                foreach ($homemainbanner as $key) {
                    if($cnt == 0){ ?>
                        <li data-target="#carousel-example-generic" class="active" data-slide-to="<?= $cnt ?>"></li>
                    <?php }else{ ?>
                        <li data-target="#carousel-example-generic" data-slide-to="<?= $cnt ?>"></li>
                    <?php } 
                        $cnt++; 
                     }
                  } 
                ?>
        </ol>

        <div class="carousel-inner" role="listbox">

            <?php $cnt=0;
                 if(!empty($homemainbanner)){
                  foreach ($homemainbanner as $key) { ?>
                
            <?php   if($cnt == 0){
                    ?>
                      <div class="item active">
                        <img src="<?= PROMOCMSBANNERPATH.$key['bannerName']; ?>"  style="width: 100%; height: 318px;">
                      </div>
              <?php     }else{ ?>
                      <div class="item">
                        <img src="<?= PROMOCMSBANNERPATH.$key['bannerName']; ?>"  style="width: 100%; height: 318px;">
                      </div>

              <?php     } 
                      $cnt++;
                    }
                }
              ?>

            <?php if ( ! $homemainbanner): ?>
                <img src="<?= IMAGEPATH.'/home/welcome-banner.jpg' ?>" style="width: 100%; height: 318px;"/>
            <?php endif ?>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
        </a>
        </div>
    </div>
    <div class="col-sm-3 col-md-3 col-lg-3" style="padding-left: 0;">
        
        <div class="panel panel-default" style="border-radius: 0;">
            <div class="panel-heading text-uppercase" style="font-family: Coolvetica; font-size: 16px; padding: 10px 30px 13px; background-image: url('<?= IMAGEPATH.'/home/news-list-group-header.png' ?>');"><?= lang('wc.01'); ?></div>
            <ul class="list-group">
                <?php foreach ($news as $key => $value): ?>
                    <li class="welcome list-group-item">
                        <label style="font-size: 14px; font-weight: bold; color: #3a7003;"><?= $value['title'] ?></label>
                        <p class="news_item" style="font-size: 12px;">
                            <?= $value['content'] ?>
                        </p>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <?php 
         if(!empty($homesmallbanner)){
            foreach ($homesmallbanner as $key) { ?>
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <a href="<?= BASEURL . 'online/casino' ?>"><img class="" src="<?= PROMOCMSBANNERPATH.$key['bannerName']; ?>" alt="Generic placeholder image" style=""></a>
                </div>
    <?php }
         } ?>
    <!-- <div class="col-lg-3">
        <a href="<?= BASEURL . 'online/casino' ?>"><img class="" src="<?= IMAGEPATH.'/home/live-casino.png' ?>" alt="Generic placeholder image" style=""></a>
    </div>
    <div class="col-lg-3">
        <a href="<?= BASEURL . 'online/sports' ?>"><img class="" src="<?= IMAGEPATH.'/home/sports.png' ?>" alt="Generic placeholder image" style=""></a>
    </div>
    <div class="col-lg-3">
        <a href="<?= BASEURL . 'online/poker' ?>"><img class="" src="<?= IMAGEPATH.'/home/poker.png' ?>" alt="Generic placeholder image" style=""></a>
    </div>
    <div class="col-lg-3">
        <a href="<?= BASEURL . 'online/keno' ?>"><img class="" src="<?= IMAGEPATH.'/home/keno.png' ?>" alt="Generic placeholder image" style=""></a>
    </div> -->
</div>
<br/>
<div class="row">
    <div class="col-sm-8 col-md-8 col-lg-8">
        <div class="panel panel-og">
            <div class="panel-heading">HOT JOBS</div>
            <div class="panel-body" style="border-top: 3px solid #366903; height: 263px; padding-top: 25px;">
                <div align="center">
                    <?php 
                         if(!empty($homegamebanner)){
                            foreach ($homegamebanner as $key) { ?>
                                 <div style="display: inline-block; margin:3px;">
                                    <a href="<?= BASEURL.'online/casino' ?>">
                                        <a href="<?= BASEURL . 'online/casino' ?>"><img class="" src="<?= PROMOCMSBANNERPATH.$key['bannerName']; ?>" style="width: 120px; height: 158px;"></a>
                                    </a>
                                    <p></p>
                                    <!-- <p style="font-size: 13.5px; font-weight: bold;">Spiderman</p> -->
                                    <img src="<?= IMAGEPATH.'/home/star.png' ?>">
                                    <img src="<?= IMAGEPATH.'/home/star.png' ?>">
                                    <img src="<?= IMAGEPATH.'/home/star.png' ?>">
                                    <img src="<?= IMAGEPATH.'/home/star.png' ?>">
                                    <img src="<?= IMAGEPATH.'/home/star.png' ?>">
                                </div>
                    <?php }
                         } ?>
                    <!-- <div style="display: inline-block;">
                        <a href="<?= BASEURL.'online/casino' ?>">
                            <img class="img-thumbnail" src="<?= IMAGEPATH.'home/game_1.jpg' ?>" alt="Generic placeholder image" style="width: 120px; height: 158px;">
                        </a>
                        <p style="font-size: 13.5px; font-weight: bold;">Spiderman</p>
                        <img src="<?= IMAGEPATH.'/home/star.png' ?>">
                        <img src="<?= IMAGEPATH.'/home/star.png' ?>">
                        <img src="<?= IMAGEPATH.'/home/star.png' ?>">
                        <img src="<?= IMAGEPATH.'/home/star.png' ?>">
                        <img src="<?= IMAGEPATH.'/home/star.png' ?>">
                    </div>
                    <div style="display: inline-block;">
                        <a href="<?= BASEURL.'online/casino' ?>">
                            <img class="img-thumbnail" src="<?= IMAGEPATH.'home/game_2.jpg' ?>" alt="Generic placeholder image" style="width: 120px; height: 158px;">
                        </a>
                        <p style="font-size: 13.5px; font-weight: bold;">Thor</p>
                        <img src="<?= IMAGEPATH.'/home/star.png' ?>">
                        <img src="<?= IMAGEPATH.'/home/star.png' ?>">
                        <img src="<?= IMAGEPATH.'/home/star.png' ?>">
                        <img src="<?= IMAGEPATH.'/home/star.png' ?>">
                        <img src="<?= IMAGEPATH.'/home/star.png' ?>">
                        
                    </div>
                    <div style="display: inline-block;">
                        <a href="<?= BASEURL.'online/casino' ?>">
                            <img class="img-thumbnail" src="<?= IMAGEPATH.'home/game_3.jpg' ?>" alt="Generic placeholder image" style="width: 120px; height: 158px;">
                        </a>
                        <p style="font-size: 13.5px; font-weight: bold;">Live Baccarat</p>
                        <img src="<?= IMAGEPATH.'/home/star.png' ?>">
                        <img src="<?= IMAGEPATH.'/home/star.png' ?>">
                        <img src="<?= IMAGEPATH.'/home/star.png' ?>">
                        <img src="<?= IMAGEPATH.'/home/star.png' ?>">
                        <img src="<?= IMAGEPATH.'/home/star.png' ?>">
                        
                    </div>
                    <div style="display: inline-block;">
                        <a href="<?= BASEURL.'online/casino' ?>">
                            <img class="img-thumbnail" src="<?= IMAGEPATH.'home/game_4.jpg' ?>" alt="Generic placeholder image" style="width: 120px; height: 158px;">
                        </a>                            
                        <p style="font-size: 13.5px; font-weight: bold;">Blackjack</p>
                        <img src="<?= IMAGEPATH.'/home/star.png' ?>">
                        <img src="<?= IMAGEPATH.'/home/star.png' ?>">
                        <img src="<?= IMAGEPATH.'/home/star.png' ?>">
                        <img src="<?= IMAGEPATH.'/home/star.png' ?>">
                        <img src="<?= IMAGEPATH.'/home/star.png' ?>">
                    </div>
                    <div style="display: inline-block;">
                        <a href="<?= BASEURL.'online/casino' ?>">
                            <img class="img-thumbnail" src="<?= IMAGEPATH.'home/game_5.jpg' ?>" alt="Generic placeholder image" style="width: 120px; height: 158px;">
                        </a>
                        <p style="font-size: 13.5px; font-weight: bold;">3D Roulette</p>
                        <img src="<?= IMAGEPATH.'/home/star.png' ?>">
                        <img src="<?= IMAGEPATH.'/home/star.png' ?>">
                        <img src="<?= IMAGEPATH.'/home/star.png' ?>">
                        <img src="<?= IMAGEPATH.'/home/star.png' ?>">
                        <img src="<?= IMAGEPATH.'/home/star.png' ?>">
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4 col-md-4 col-lg-4">
        <div class="panel panel-og">
            <div class="panel-heading text-uppercase">FREELANCE JOBS</div>
            <div class="panel-body">
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading page-header text-uppercase"><?= lang('wc.10'); ?></h4>
                        <div style="font-size: 14px; color: #305e04; margin-bottom: 5px;"><strong>£ 1,000,000</strong></div>
                        <a href="<?= BASEURL.'online/casino' ?>" class="btn btn-og text-uppercase"><?= lang('wc.11'); ?></a>
                    </div>
                    <div class="media-right media-top">
                        <img class="media-object" src="<?= IMAGEPATH.'/home/jackpot.png' ?>">
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-og">
            <div class="panel-heading text-uppercase">PART TIME JOBS</div>
            <div class="panel-body">
                <div clas="media-list">
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading"><?= lang('wc.13'); ?> <span class="text-uppercase" style="font-size: 17px; font-weight: bold; color: #1f5501;"><?= lang('wc.14'); ?></h4>
                        <!-- <a href="#" class="btn btn-og text-uppercase"><?= lang('wc.15'); ?></a> -->
                    </div>
                    <div class="media-right media-top">
                        <img class="media-object" src="<?= IMAGEPATH.'/home/vip.png' ?>">
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>