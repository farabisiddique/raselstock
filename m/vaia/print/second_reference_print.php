<p class='cut_line'>&#9986;---------------------------&#9986;--------------------------&#9986;--------------------------&#9986;--------------------------&#9986;---------------------------&#9986;----------------&#9986;</p>

<div class="ref_main ref_raselbg" style="margin-top: 2%;">
    <div class="middle">
        <div class="ref_topname">
            <h1 class="narrow_height" style="color: blue;"> মেসার্স রাসেল এন্টারপ্রাইজ </h1>
            <h2 class="narrow_height" style="color: red;">নিত্য প্রয়োজনীয় পণ্যের কমিশন এজেন্ট</h2>
            <h3 class="narrow_height" style="color: green; font-size: 18px;"> ০১৬২৭-৭২০৩৭১ ০১৯৪০-৭৫৭১০৬ </h3>
            <h3 class="narrow_height" style="color: blue; margin-bottom: 15px;">আব্দুল জাব্বার মার্কেট, ঢাকা-চট্রগ্রাম মহাসড়ক সংলগ্ন, রামপুর রাস্তার মাথায়, ফেনী সদর, ফেনী</h3>
            <span  class="memoname" style="color: green;">২য় প্রতিনিধি  মেমো </span>
        </div>
        <div class="ref_holder_info">
            <div class="ref_holder_info_part">
              <div class="ref_holder_info_part1" style="text-align: left;">
                <h3>কোডঃ <span style="color: red;">&nbsp;<?php  echo $invoice_no; ?></span></h3>
                <h3>প্রতিনিধির নামঃ 
                  <span class="b_holder">
                    <?php  echo $sr_name; ?>
                  </span>
                </h3>
                <h3>মোবাইল নাম্বারঃ
                  <span class="b_holder">
                    <?php  echo $sr_phone; ?>
                  </span>
                </h3>
              </div>
              <div class="ref_holder_info_part2" style="line-height: 1.2;">
                  <h3>মূল প্রতিনিধির নামঃ 
                    <span class="b_holder">
                      <?php  echo $ref_name; ?>
                    </span>
                  </h3>
                  <h3>মোবাইল নাম্বারঃ
                    <span class="b_holder">
                      <?php  echo $ref_phone; ?>
                    </span>
                  </h3>
              </div>
            </div>
            <div class="ref_holder_info_part" style="float: right;">
              <div class="ref_holder_info_part1" style="line-height: 0.5;">
                    <h3>বিজনেস হোল্ডারঃ
                      <span class="b_holder">
                        <?php  echo $stock_holder_name; ?>
                      </span>
                    </h3>
                    <h3>মোবাইল নাম্বারঃ
                      <span class="b_holder">
                        <?php  echo $stock_holder_phone; ?>
                      </span>
                    </h3>
                    <h3>স্টক সংখ্যাঃ 
                      <span class="b_holder">
                        <?php  echo $stock_amount; ?>
                      </span>
                    </h3>
                    <h3 style="line-height: 1.4;">এরিয়া : 
                      <span class="b_holder">
                        <?php  echo $stock_holder_address; ?>
                      </span>
                    </h3>
              </div>
              <div class="ref_holder_info_part2" style="line-height: 1.2;">
                  <h3 style="margin-right: 75px;">অর্ডার তারিখ : 
                    <span class="buy_date"><?php  echo date('d-m-Y', strtotime("$order_date")); ?>&nbsp;ইং</span>
                  </h3>
                  <h3 style="margin-right: 75px;">ডেলিভারী তারিখ : 
                    <span class="buy_date"><?php  echo date('d-m-Y', strtotime("$delivery_date")); ?>&nbsp;ইং</span>
                  </h3>
                  <h3 style="margin-right: 75px;">অর্ডার স্ট্যাটাসঃ 
                    <span class="buy_date"><?php  echo strtoupper($status); ?>&nbsp;</span>
                  </h3>
              </div>
            </div>
        </div>
        <div class="ref_first_table">
          <table>
            <thead>
              <tr>
                <th>নং</th>
                <th>বিবরণ</th>
                <th>ব্র্যান্ড</th>
                <th>পরিমাণ</th>
                <th>কেজি/গ্রাম</th>
                <th>দর</th>
                <th>টাকা</th>
              </tr>
            </thead>
            <tbody>
              <tr> 
                <td>০১</td>
                <td><?php  echo $product_name; ?></td>
                <td class="brand_name"><?php echo $brand_name; ?></td>
                <td><?php  echo $product_amount; ?></td>
                <td><span><?php  echo $product_ideal_amount; ?></span></td>
                <td><span><?php echo $product_unit_price; ?>&nbsp;</span>টাকা</td>
                <td><span class="milk_total"><?php echo $total;?>&nbsp;</span>টাকা </td>
              </tr>
              <tr>
                <td colspan="5">&nbsp;</td>
                <td>মোট</td>
                <td><span class="grand_total"><?php echo $total;?>&nbsp;</span>টাকা</td>
              </tr>
            </tbody>
          </table>  
        </div>
        <div class="ref_second_table">
          <table class="maintable">
            <thead>
              <tr>
                <th>দিন</th>
                <th>প্রতিনিধি কমিশন প্রদানের তারিখ </th>
                <th>প্রতিনিধি কমিশন, প্রতি 15 দিনে <?php echo $second_referral_percentage; ?>%</th>
                <th>পেমেন্ট পদ্ধতি</th>
                <th>পেমেন্ট স্ট্যাটাস</th>
                <th>সাক্ষর</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>১ম</td>
                <td><span><?php echo date('d/m/Y', strtotime("$comission_date_1"));?></span></td>
                <td><?php echo $second_ref_comission; ?>/-&nbsp;</td>
                <td><?php  echo $payment_method; ?></td>
                <td>
                  <?php 

                    if($second_referral_payment==1 || $second_referral_payment==2 || $second_referral_payment==3){
                      echo "PAID";
                    }
                    else{
                      echo "&nbsp;";
                    }

                  ?>
                </td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>২য়</td>
                <td><span><?php echo date('d/m/Y', strtotime("$comission_date_2"));?></span></td>
                <td><?php echo $second_ref_comission; ?>/-&nbsp;</td>
                <td><?php  echo $payment_method; ?></td>
                <td>
                  <?php 

                    if($second_referral_payment==2 || $second_referral_payment==3){
                      echo "PAID";
                    }
                    else{
                      echo "&nbsp;";
                    }

                  ?>
                </td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>৩য়</td>
                <td><span><?php echo date('d/m/Y', strtotime("$comission_date_3"));?></span></td>
                <td><?php echo $second_ref_comission; ?>/-&nbsp;</td>
                <td><?php  echo $payment_method; ?></td>
                <td>
                  <?php 

                    if($second_referral_payment==3){
                      echo "PAID";
                    }
                    else{
                      echo "&nbsp;";
                    }

                  ?>
                </td>
                <td>&nbsp;</td>
              </tr>

            </tbody>
          </table>      
        </div>   
    </div>
</div>