<dl>
<? //pprint($this->user);?>
  <dt><label for="fname">First Name:</label></dt>
  <dd><input type="text" value="<?=$this->user["fname"]?>" name="fname"/></dd>
  <dt><label for="lname">Last Name:</label></dt>
  <dd><input type="text" value="<?=$this->user["lname"]?>" name="lname"/></dd>
  <dt><label for="gender">Gender:</label></dt>
  <dd>
    <select name="gender">
      <option></option>
      <option <? if($this->user["gender"]=="F"){?>selected="selected"<? }?> value="F">Female</option>
      <option <? if($this->user["gender"]=="M"){?>selected="selected"<? }?> value="M">Male</option> 
    </select>
  </dd>
  <dt><label for="gender">Relationship status:</label></dt>
  <dd>
    <select name="relationshipStatus">
      <? foreach($this->relationshipStatus as $k=>$relationshipStatus){?>
      <option  <? if($this->user["relationshipStatus"]==$k){?>selected="selected"<? }?> value="<?=$k?>"><?=$relationshipStatus?></option>
      <? }?>
    </select>
  </dd>
  <dt><label for="month">Birthday day:</label></dt>
  <dd>
    <select id="month" name="month" class="s">
<?
$birthDay = explode("-",$this->user["birthDay"]);
$M = array("M","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
foreach($M as $k=>$m)
{	
?>
      <option <? if($birthDay[1]==$k){?>selected="selected"<? }?> value="<?=$k?>"><?=$m?></option>
<?
}
?>
    </select>
    <select id="day" name="day" class="s">
      <option value="0">D</option>
      <? for($i=1;$i<32;$i++){?>
      <option <? if($birthDay[2]==$i){?>selected="selected"<? }?> value="<?=$i?>">
      <?=$i?>
      </option>
      <? }?>
    </select>
  </dd>
  <dt><label for="year">Birthday year:</label></dt>
  <dd>
    <select id="year" name="year" class="s">
      <option value="0">Y</option>
      <? for($i=date("Y");$i>(date("Y")-80);$i--){?>
      <option <? if($birthDay[0]==$i){?>selected="selected"<? }?> value="<?=$i?>">
      <?=$i?>
      </option>
      <? }?>
    </select>
  </dd>
  <dt><label for="email" class="required">Email address:</label></dt>
  <dd><select name="email"><option value="<?=$this->user["email"]?>"><?=$this->user["email"]?> (not editable)</option></select></dd>
  <dt><label for="password" class="required">Password:</label></dt>
  <dd><input type="password" value="<?=$this->user["password"]?>" name="password"/></dd>
  <dt><label for="address">Address:</label></dt>
  <dd><input type="text" value="<?=$this->user["address"]?>" name="address"/>
  	<select name="address_visible">
      <? foreach($this->visible as $k=>$visible){?>
      <option <? if($this->user["address_visible"]==$k){?>selected="selected"<? }?> value="<?=$k?>"><?=$visible?></option>
      <? }?>
    </select>
    </dd>
  <dt><label for="city">City:</label></dt>
  <dd><input type="text" value="<?=$this->user["city"]?>" name="city"/></dd>
  <dt><label for="state">State:</label></dt>
  <dd><input type="text" value="<?=$this->user["state"]?>" name="state"/></dd>
  <dt><label for="zip">Zip/Postal code:</label></dt>
  <dd><input type="text" value="<?=$this->user["zip"]?>" name="zip"/></dd>
  <dt><label for="country">Country:</label></dt>
  <dd>
    <select id="country" name="country" class="s">
      <option value="0"></option>
      <? foreach($this->country as $k=>$name){?>
      <option  <? if($this->user["country"]==$k){?>selected="selected"<? }?> value="<?=$k?>"><?=$name?></option>
      <? }?>
    </select>
  </dd>
  <dt><label for="language">Languages i speak:</label></dt>
  <dd>
    <select id="language" name="language" class="s">
      <option value="0"></option>
      <? foreach($this->language as $k=>$language){?>
      <option  <? if($this->user["language"][0]["language"]==$k){?>selected="selected"<? }?> value="<?=$k?>"><?=$language?></option>
      <? }?>
    </select>
  </dd>
  <dt><label class="required">Interested in:</label></dt>
  <dd>
  <? foreach($this->interested as $k=>$interested){?>
  <label>
  	<input type="checkbox" name="interested_<?=$k?>" <? if(is_array($this->user["interested"])&&in_array($k,$this->user["interested"])){?>checked="checked"<? }?> value="<?=$k?>" /><?=$interested?>
  </label>
  <? }?>
  </dd>
  <dt>&nbsp;</dt>
  <dd><a href="javascript:;"><img src="<?=IMAGES?>update.gif" border="0" /></a></dd>
</dl>