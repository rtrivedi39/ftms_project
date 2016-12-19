<?php
$section = get_list(SECTIONS,null,array('section_id' => $sce_id));

$query = $this->db->query("select count(file_id) as counts FROM ft_files where `file_mark_section_id`='".$sce_id."' and `file_return` !='2' and (file_hardcopy_status = 'received' or file_hardcopy_status = 'working')");
$res1 =  $query->row_array();
$query = $this->db->query("select count(file_id) as counts FROM ft_files where `file_mark_section_id`='".$sce_id."' and `file_return` !='2' and (file_hardcopy_status = 'not')");
$res2 =  $query->row_array();
$query = $this->db->query("select count(file_id) as counts FROM ft_files where `file_mark_section_id`='".$sce_id."' and `file_return` ='2'");
$res3 =  $query->row_array();
?>
<div class="col-md-12">
    <div class="box box-warning">
        <div class="box-header">
            <h3 class="box-title"><?php echo $section[0]['section_name_hi']." (".$section[0]['section_name_en'].")" ?> Section</h3>
        </div><!-- /.box-header -->
        <div class="box-body no-padding">
            <table class="table table-condensed">
                <tr>
                    <th>#</th>
                    <th>Section</th>
                    <th>Received</th>
                    <th>Not Received</th>
                    <th>Dispatch</th>
                    <th>Total</th>
                </tr>
                <tr>
                    <td>1.</td>
                    <td><?php echo $section[0]['section_name_hi']." (".$section[0]['section_name_en'].")" ?></td>
                    <td><a data-toggle="tooltip" data-original-title="Click Here For Display Files" href="<?php echo base_url(); ?>reports/moniter?secid=<?php echo $section[0]['section_id'] ?>&s=receive" ><?php echo $res1['counts']; ?></a></td>
                    <td><a data-toggle="tooltip" data-original-title="Click Here For Display Files" href="<?php echo base_url(); ?>reports/moniter?secid=<?php echo $section[0]['section_id'] ?>&s=not" ><?php echo $res2['counts']; ?></a></td>
                    <td><a data-toggle="tooltip" data-original-title="Click Here For Display Files" href="<?php echo base_url(); ?>reports/moniter?secid=<?php echo $section[0]['section_id'] ?>&s=2" ><?php echo $res3['counts']; ?></a></td>
                    <td><a data-toggle="tooltip" data-original-title="Click Here For Display Files" href="<?php echo base_url(); ?>reports/moniter?secid=<?php echo $section[0]['section_id'] ?>" ><?php echo $res1['counts'] + $res2['counts'] + $res3['counts']; ?></a></td>
                </tr>
            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div>

<div class="col-md-12">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?php echo $section[0]['section_name_hi']." (".$section[0]['section_name_en'].")" ?> Section</h3>
        </div><!-- /.box-header -->
        <div class="box-body no-padding">
            <table class="table table-condensed">
                <tr>
                    <th>#</th>
                    <th>File Level</th>
                    <th>Total File</th>
                    <th>Received</th>
                    <th>Not Received</th>
                </tr>
                <?php
                $qry = $this->db->query("SELECT file_received_emp_id , count(file_id) AS fileno, SUM(IF(file_hardcopy_status = 'received' || file_hardcopy_status = 'working', 1,0)) AS received, SUM(IF(file_hardcopy_status = 'not', 1,0)) AS notreceive FROM ft_files WHERE `file_mark_section_id`='".$sce_id."' GROUP by `file_received_emp_id` ORDER BY fileno DESC");
                if($qry->num_rows() != 0) {
                $i = '1';
                foreach($qry->result() as $record1){
                    $emp = get_user_details($record1->file_received_emp_id);
                    $emp1 = $emp[0];
                    ?>
                    <tr>
                        <td><?php echo $i ;?>.</td>
                        <td><?php  echo $emp1->emp_full_name." (".$emp1->emprole_name_hi.")" ;?></td>
                        <td><a data-toggle="tooltip" data-original-title="Click Here For Display Files" href="<?php echo base_url(); ?>reports/moniter?secid=<?php echo $section[0]['section_id'] ?>&emp=<?php echo $record1->file_received_emp_id; ?>" ><?php echo $record1->fileno; ?></a></td>
                        <td><a data-toggle="tooltip" data-original-title="Click Here For Display Files" href="<?php echo base_url(); ?>reports/moniter?secid=<?php echo $section[0]['section_id'] ?>&s=receive&emp=<?php echo $record1->file_received_emp_id; ?>" ><?php echo $record1->received; ?></a></td>
                        <td><a data-toggle="tooltip" data-original-title="Click Here For Display Files" href="<?php echo base_url(); ?>reports/moniter?secid=<?php echo $section[0]['section_id'] ?>&s=not&emp=<?php echo $record1->file_received_emp_id; ?>" ><?php echo $record1->notreceive; ?></a></td>
                    </tr>
                    <?php $i++; }} else{ ?>
                    <tr>
                        <td colspan="5" align="center"> No Records Found  </td>
                    </tr>
               <?php } ?>
            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div>
