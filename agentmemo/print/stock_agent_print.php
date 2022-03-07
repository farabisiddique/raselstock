
      <div class="ref_main ref_raselbg">
              <div class="middle">
                <div class="ref_topname">
                  <h1 class="narrow_height" style="color: blue;"> মেসার্স রাসেল এন্টারপ্রাইজ </h1>

                  <h2 class="narrow_height" style="color: red;">নিত্য প্রয়োজনীয় পণ্যের কমিশন এজেন্ট</h2>

                  <h3 class="narrow_height" style="color: green; font-size: 18px;"> ০১৬২৭-৭২০৩৭১ ০১৯৪০-৭৫৭১০৬ </h3>

                  <h3 class="narrow_height" style="color: blue; margin-bottom: 15px;">আব্দুল জাব্বার মার্কেট, ঢাকা-চট্রগ্রাম মহাসড়ক সংলগ্ন, রামপুর রাস্তার মাথায়, ফেনী সদর, ফেনী</h3>
                  <span  class="memoname" style="color: green;">এজেন্ট মেমো </span>

                </div>
                <div class="ref_holder_info">
                  <div class="ref_holder_info_part">
                    <h3>নং :<span style="color: red;">&nbsp;<?php  echo $memo_no; ?></span></h3>
                    <h3>এজেন্ট হোল্ডার :
                      <span class="b_holder">
                        <?php  echo $agent_holder_name; ?>
                      </span>
                    </h3>
                    <h3>মোবাইল নাম্বারঃ
                      <span class="b_holder">
                        <?php  echo $agent_holder_phone; ?>
                      </span>
                    </h3>
                    <h3>এন আই ডি নম্বর :
                      <span class="b_holder">
                        <?php  echo $nid_no; ?>
                      </span>
                    </h3>
                    <h3>এজেন্ট সংখ্যাঃ 
                      <span class="b_holder">
                        <?php  echo $stock_amount; ?>
                      </span>
                    </h3>
                    <h3>এজেন্ট  অফিসঃ 
                      <span class="b_holder">
                        <?php  echo $agent_office; ?>
                      </span>
                    </h3>
                  </div>
                  <div class="ref_holder_info_part" style="float: right;">
                    
                    <h3 style="text-align:right; margin-right: 75px;">ডেলিভারী তারিখ : 
                      <span class="buy_date"><?php  echo date('d-m-Y', strtotime("$delivery_date")); ?>&nbsp;ইং</span>
                    </h3>
                    
                  </div>    
                </div>
                <div class="ref_first_table">
                    <table>
                      <thead>
                        <tr>
                          <th>নং</th>
                          <th>বিবরণ</th>
                          <th>পরিমাণ</th>
                          <th>কেজি/গ্রাম</th>
                          <th>দর</th>
                          <th>টাকা</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr> 
                          <td>০১</td>
                          <td><?php  echo $main_product; ?></td>
                          <td><span><?php  echo $product_amount; ?>&nbsp;প্যাকেট</span></td>
                          <td><?php  echo $amount_per_packet; ?></td>
                          
                          <td><span><?php echo $unit_price; ?>&nbsp;</span>টাকা</td>
                          <td><span class="milk_total"><?php echo $total;?>&nbsp;</span>টাকা </td>
                        </tr>

                        <tr>
                          <td colspan="4"><span>কমিশন পরবর্তী সময়ে, প্রদানকৃত অর্থের সমপরিমাণ পণ্য প্রতিষ্ঠানকে প্রদান করিতে বাধ্য থাকিবে।  </span></td>
                          <td>মোট</td>
                          <td><span class="grand_total"><?php echo $total;?>&nbsp;</span>টাকা</td>

                        </tr>
                        
                      </tbody>
                    </table>
                </div>
                <div class="second_table">
                  <table class="maintable">
                    <thead class="text-center">
                      <tr class="table-info">
                      <th scope="col">দিন</th> 
                        <th scope="col">প্রতি <?php echo $comission_day_interval_show; ?>তম দিনে পুঁজি ফেরত মোট মূল্যের  <?php echo $comission_percentage; ?>%</th>
                        <th scope="col">প্রতি <?php echo $comission_day_interval_show; ?>তম দিনে কমিশন প্রদান মোট মূল্যের <?php echo $comission_percentage_2; ?>%</th>

                        
                        <th scope="col">পেমেন্ট তারিখ</th>
                        <th scope="col">সাক্ষর</th>
                        
                      </tr>
                    </thead>
                    <tbody class="text-center">

                     

                      <?php  


                        for($i=0;$i<$how_many_comission_date;$i++){

                          echo "<tr class='tables_row'>";
                          echo "<td>".$din_array[$i]."&nbsp;১১তম দিন</td>";
                          echo "<td class='comission_amount'>".$comission_amount."/-</td>";
                          

                          if($i>=$how_many_comission_date/2){
                            echo "<td class='comission_amount_2'>".(int)($comission_amount_2/2)."/-</td>";
                          }
                          else{
                            echo "<td class='comission_amount_2'>".$comission_amount_2."/-</td>";
                          }

                          echo "<td>".date_formatter($comission_date_array[$i],'d-m-Y')."</td>";
                          echo "<td class='sinnature'>&nbsp;</td>";
                          echo "</tr>";

                        }

                      ?>

                     

                      

                    </tbody>
                  </table>
                </div>

              </div>
      </div>
      