<style type='text/css'>
.z_metabox{overflow:auto;padding:10px 10px}
.z_metabox_field{margin-bottom:15px;width:100%;overflow:hidden}
.z_metabox_field label{font-weight:bold;float:left;width:15%}
.radio{}
.z_metabox_field .field{float:left;width:75%}
.z_metabox_field input[type=text], .z_metabox_field textarea {width:100%}
.tabs{position:relative;min-height:200px;clear:both;margin:25px 0}
.tab{float:left}
.label{background:#eee;padding:10px;border:1px solid #ccc;margin-left:-1px;position:relative;left:1px}
.input[type=radio]{display:none}
.z_metabox{position:absolute;top:28px;left:0;background:white;right:0;bottom:0;border:1px solid #ccc}
.input[type=radio]:checked ~ label{background:white;border-bottom:1px solid white;z-index:2}
.input[type=radio]:checked ~ .label ~ .z_metabox{z-index:1}
</style>


<input class="input" type="radio" id="tab-1" name="tab-group-1" checked>


<?php
$this->select('hotroandroid','Hỗ trợ Android',array('' => 'Không','<Android></Android>' => 'Có'),'');	
$this->select('hotroios','Hỗ trợ IOS',array('' => 'Không','<Ios></Ios>' => 'Có'),'');	
$this->select('hotrojava','Hỗ trợ Java',array('' => 'Không','<Java></Java>' => 'Có'),'');	
//$this->text('heading', 'Tiêu đề', '');
/* $this->select('score','Xếp hạng',array('Star1' => '1','Star15' => '1.5','Star2' => '2','Star25' => '2.5','Star3' => '3','Star35' => '3.5','Star4' => '4','Star45' => '4.5','Star5' => '5'),'');			 */
$this->text('link_download', 'Link tải');
$this->text('qr_code', 'Link QR Code');
$this->text('kichthuoc', 'Dung lượng');
$this->text('phienban', 'Phiên bản');
$this->text('yeucau', 'Yêu cầu');
$this->select('thongtinkhac','Thông tin khác',array('hot2' => 'HOT','update2' => 'UPDATE','new2' => 'NEW'),'');		
?>


