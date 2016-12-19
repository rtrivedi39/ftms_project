<div class="form-group">
                    <table width="100%">
                        <tr>
                            <td><b>दिनांक</b></td>
                            <td><b>कोई टीप</b></td>
                            <td><b>कौन लाया</b></td>
                            <td><b>क्या हुआ</b></td>
                            <td><b>दस्तावेज</b></td>
                        </tr>
                        <?php $sublogin=array(); foreach($file_log as $row){
                            // if($row['to_emp_id'] != $row['from_emp_id']){
                            $empnmto = get_user_details($row['to_emp_id']);
                            $empnmfrom = get_user_details($row['from_emp_id']);
                            if(isset($row['sublogin']) && $row['sublogin']!=''){
                                $sublogin = get_user_details($row['sublogin']);
                            }
							//echo 'FTMS';
                            ?>
                            <tr>
                                <td><?php  echo date_format(date_create($row['flog_created_date']), 'd/m/Y g:ia'); ?></td>
                                <td><?php echo @$row['flog_other_remark'] ? $row['flog_other_remark'] : '-' ; ?>

                                    <?php if($row['sublogin'] != 0 && $row['sublogin'] !=$row['to_emp_id'] && $row['sublogin'] !=$row['from_emp_id'] ){
                                        echo 'Worked by '. $sublogin[0]->emp_full_name_hi.'( '. $sublogin[0]->emprole_name_hi .') on behalf of Officer';
                                    } ?></td>
                                <td><?php echo @$row['hardcopy_carry_empname'] ? $row['hardcopy_carry_empname'] : '-' ; ?></td>
                                <td><?php
                                    if($row['to_emp_id'] == $row['from_emp_id']){
                                        if (isset($empnmto[0]->emp_full_name_hi)) {
                                            if(isset($row['fvlm_id']) && $row['fvlm_id'] == 1){
                                               
                                                echo  file_status_withname($empnmto[0]->emp_id,$empnmto[0]->emp_full_name_hi,$empnmto[0]->emprole_name_hi);
												echo " के द्वारा बंद कर दी  गई | ";
                                            }else if(isset($row['fvlm_id']) && $row['fvlm_id'] == 4){
                                                echo " File Merged by ";
                                                echo  file_status_withname($empnmto[0]->emp_id,$empnmto[0]->emp_full_name_hi,$empnmto[0]->emprole_name_hi);
                                            }else {
                                               
                                                echo  file_status_withname($empnmto[0]->emp_id,$empnmto[0]->emp_full_name_hi,$empnmto[0]->emprole_name_hi);
											   echo " के पास प्रक्रियाधीन | ";
												physical_electronic_file_status_receive( $row['file_status_log']);
                                            } }

                                    } else {
                                        if(isset($row['fvlm_id']) && $row['fvlm_id'] == 2){
                                            if (isset($empnmfrom[0]->emp_full_name_hi)) {
                                                echo "File from ";
                                                echo file_status_withname($empnmfrom[0]->emp_id,$empnmfrom[0]->emp_full_name_hi,$empnmfrom[0]->emprole_name_hi);
                                            }
                                            if (isset($empnmto[0]->emp_full_name_hi)) {
                                                echo " Recalled by ";
                                                echo file_status_withname($empnmto[0]->emp_id,$empnmto[0]->emp_full_name_hi,$empnmto[0]->emprole_name_hi);
                                            }

                                        }elseif(isset($row['fvlm_id']) && $row['fvlm_id'] == 3){
                                            if (isset($empnmto[0]->emp_full_name_hi)) {
                                                echo "File from ";
                                                echo file_status_withname($empnmto[0]->emp_id,$empnmto[0]->emp_full_name_hi,$empnmto[0]->emprole_name_hi);
                                            }
                                            if (isset($empnmfrom[0]->emp_full_name_hi)) {
                                                echo " Rejected by";
                                                echo file_status_withname($empnmfrom[0]->emp_id,$empnmfrom[0]->emp_full_name_hi,$empnmfrom[0]->emprole_name_hi);
                                            }
                                        }else{
                                        if (isset($empnmfrom[0]->emp_full_name_hi)) {
                                            echo file_status_withname($empnmfrom[0]->emp_id,$empnmfrom[0]->emp_full_name_hi,$empnmfrom[0]->emprole_name_hi);
                                           echo " द्वारा  ";
                                        }
                                        if (isset($empnmto[0]->emp_full_name_hi)) {
                                            echo file_status_withname($empnmto[0]->emp_id,$empnmto[0]->emp_full_name_hi,$empnmto[0]->emprole_name_hi);
											echo " को प्रेषित |";
                                        }
                                    }
										physical_electronic_file_status_send($row['file_status_log']);
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
									if($this->session->userdata('user_role') != '9' && $this->session->userdata('user_role') != '39'){
									if($row['notesheet_file_path'] != '') { ?>
                                        <?php /* <a href="<?php echo base_url().'/uploads/notesheets/'.getSection($row['section_id'], true).'/'.$row['notesheet_file_path'];  ?>" target="_blank"><i class="fa fa-file-pdf-o text-red"></i> <i class="fa fa-cloud-download text-green"></i></a>*/ ?>
                                        <a href="<?php echo base_url().'view_file/view_file/view_notesheet/'.$row['flog_id'];  ?>" target="_blank"><i class="fa fa-file-pdf-o text-red"></i> </a>
										 <!--<a title="Edit Notesheet" style="margin-left:5px" href="<?php //echo base_url().'admin_notesheet_master/view_file_notesheet/'.$row['notesheet_id'].'/'.$row['section_id'].'/'.$row['file_id'];  ?>" target="_blank"><img height="30" width="30" src="<?php //echo base_url();?>images/edit.png" style="height:15px !important; width:15px !important"> </a>-->
                                    <?php }} ?>
                                    <?php if($row['document_path'] != '') {
                                        $path_t = explode(',',$row['document_path']);
                                        foreach($path_t as $path_r){
                                            //    echo $path_r;
                                            ?>
                                            <a title="Attached PDF" style="margin-left:5px" href="<?php echo base_url().''.$path_r;  ?>" target="_blank"><button class="btn btn-sm" type="button"> <i class="fa fa-file-pdf-o text-red"></i> </button></a>
                                        <?php }} ?>
                                    <?php if(isset($row['file_headerpath']) && $row['file_headerpath'] != '') {
                                        $file_meargeid =  unserialize($row['file_headerpath']);
                                        foreach($file_meargeid as $file_mearge){ ?>
                                            <a href="<?php echo base_url();?>view_file/viewdetails/<?php echo $file_mearge ;?>"><button type="button" class="btn bg-light-blue btn-xs" title="<?php echo "fileid ". $file_mearge ?>"><?php echo "पंजी क्रं ". getfilesec_id_byfileid($file_mearge,$row['section_id']) ?></button></a>
                                        <?php  } } ?>
                                </td>
                            </tr>

                            <?php //}
                        } ?>
                    </table>

                </div>