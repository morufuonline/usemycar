                      <div class="title-section">PRODUCT SUMMARY</div>
                    <div class="lefty-content">
                        <ul class="left-sell-ul">
                          <li>
                            <div class="label-title"><i class="fa fa-car" aria-hidden="true"></i> Brand</div>
                            <div class="label-value"><?php check_inputted("brand"); ?></div>
                          </li>
                          <li>
                            <div class="label-title"><i class="fa fa-car" aria-hidden="true"></i> Model</div>
                            <div class="label-value"><?php check_inputted("model"); ?></div>
                          </li>
                            <li>
                            <div class="label-title"><i class="fa fa-calendar-o" aria-hidden="true"></i> Year</div>
                            <div class="label-value"><?php check_inputted("year"); ?></div>
                          </li>
                          <li>
                            <div class="label-title"><i class="fa fa-car" aria-hidden="true"></i> Trim</div>
                            <div class="label-value"><?php check_inputted("trim"); ?></div>
                          </li>
                            <li>
                            <div class="label-title"><i class="fa-fuel"></i> Fuel</div>
                            <div class="label-value"><?php check_inputted("fuel"); ?></div>
                          </li>
                            <li>
                            <div class="label-title"><i class="fa-car-door"></i> Doors</div>
                            <div class="label-value"><?php check_inputted("doors"); ?></div>
                          </li>
                            <li>
                            <div class="label-title"><i class="fa-car-transmission"></i> Transmission</div>
                            <div class="label-value"><?php check_inputted("transmission"); ?></div>
                          </li>
                            <li>
                            <div class="label-title"><i class="fa fa-car" aria-hidden="true"></i>  Body Type</div>
                            <div class="label-value"><?php check_inputted("type"); ?></div>
                          </li>
                            <li>
                            <div class="label-title"><i class="fa-car-engine"></i> Engine</div>
                            <div class="label-value"><?php $this_engine = ret_check_inputted("engine"); if(!empty($this_engine)){ echo "{$this_engine} CC"; }; ?></div>
                          </li>
                            <li>
                            <div class="label-title"><i class="fa fa-battery-full" aria-hidden="true"></i> Power</div>
                            <div class="label-value"><?php $this_power = ret_check_inputted("power"); if(!empty($this_power)){ echo "{$this_power} HP"; }; ?></div>
                          </li>
                           <li>
                            <div class="label-title"><i class="fa-car-condition"></i> Condition</div>
                            <div class="label-value"><?php check_inputted("condition"); ?></div>
                          </li>
                           <li>
                            <div class="label-title"><i class="fa fa-tachometer" aria-hidden="true"></i> Mileage</div>
                            <div class="label-value"><?php $this_mileage = ret_check_inputted("mileage"); if(!empty($this_mileage)){ echo "{$this_mileage} Kms"; }; ?></div>
                          </li>
                           <li>
                            <div class="label-title"><i class="fa-car-spec"></i> Specs</div>
                            <div class="label-value"><?php check_inputted("specs"); ?></div>
                          </li>
                             <li>
                            <div class="label-title"><i class="fa-car-paint"></i> Colour</div>
                            <div class="label-value"><?php check_inputted("colour"); ?></div>
                          </li>
                             <li>
                            <div class="label-title"><i class="fa fa-money" aria-hidden="true"></i> Price</div>
                            <div class="label-value"><?php $this_price = ret_check_inputted("price"); if(!empty($this_price)){ echo "&#8358;" . formatNumber($this_price); } ?></div>
                          </li>
                           <li>
                            <div class="label-title"><i class="fa fa-map-marker" aria-hidden="true"></i> Location</div>
                            <div class="label-value"><?php $this_local_government = ret_check_inputted("local_government"); if(!empty($this_local_government)){ echo "{$this_local_government}, "; check_inputted("state"); } ?></div>
                          </li>
                        </ul>
                         <div class="clearfix"></div>
                         <div class="features-section clearfix"><ul><div class="title">Equipment</div>
                         <p><?php 
						 $this_equipment = ret_check_inputted("equipment"); 
						 if(!empty($this_equipment)){ $equipment_array = explode("+*/-", $this_equipment);
						$equipment_val = "";
						if(count($equipment_array) > 1){
						foreach($equipment_array as $val){
						$equipment_val .= (!empty($val))?"{$val}, ":"";
						}
						}
						echo substr($equipment_val,0,-2); } ?></p></ul>
                         </div>