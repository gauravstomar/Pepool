<dl>
  <dt>
    <label for="children"> i like children:</label>
  </dt>
  <dd>
    <select name="children">
      <? foreach($this->socials['children'] as $k=>$v){?>
      <option  <? if($this->user["social"]["children"]==$k){?>selected="selected"<? }?> value="<?=$k?>">
      <?=$v?>
      </option>
      <? }?>
    </select>
  </dd>
  <dt>
    <label for="ethnicity"> my ethnicity:</label>
  </dt>
  <dd>
    <select name="ethnicity">
      <? foreach($this->socials['ethnicity'] as $k=>$v){?>
      <option  <? if($this->user["social"]["ethnicity"]==$k){?>selected="selected"<? }?> value="<?=$k?>">
      <?=$v?>
      </option>
      <? }?>
    </select>
  </dd>
  <dt>
    <label for="religion"> my religion:</label>
  </dt>
  <dd>
    <select name="religion">
      <? foreach($this->socials['religion'] as $k=>$v){?>
      <option  <? if($this->user["social"]["religion"]==$k){?>selected="selected"<? }?> value="<?=$k?>">
      <?=$v?>
      </option>
      <? }?>
    </select>
  </dd>
  <dt>
    <label for="political"> my political view:</label>
  </dt>
  <dd>
    <select name="political">
      <? foreach($this->socials['politicalView'] as $k=>$v){?>
      <option  <? if($this->user["social"]["political"]==$k){?>selected="selected"<? }?> value="<?=$k?>">
      <?=$v?>
      </option>
      <? }?>
    </select>
  </dd>
  <dt>
    <label for="humor"> my humor style:</label>
  </dt>
  <dd>
    <select name="humor">
      <? foreach($this->socials['humor'] as $k=>$v){?>
      <option  <? if($this->user["social"]["humor"]==$k){?>selected="selected"<? }?> value="<?=$k?>">
      <?=$v?>
      </option>
      <? }?>
    </select>
  </dd>
  <dt>
    <label for="sexualOrientation"> my sexual orientation:</label>
  </dt>
  <dd>
    <select name="sexualOrientation">
      <? foreach($this->socials['sexualOrientation'] as $k=>$v){?>
      <option  <? if($this->user["social"]["sexualOrientation"]==$k){?>selected="selected"<? }?> value="<?=$k?>">
      <?=$v?>
      </option>
      <? }?>
    </select>
  </dd>
  <dt>
    <label for="fashion"> fashion funda:</label>
  </dt>
  <dd>
    <select name="fashion">
      <? foreach($this->socials['fashion'] as $k=>$v){?>
      <option  <? if($this->user["social"]["fashion"]==$k){?>selected="selected"<? }?> value="<?=$k?>">
      <?=$v?>
      </option>
      <? }?>
    </select>
  </dd>
  <dt>
    <label for="smoking"> smoking for me:</label>
  </dt>
  <dd>
    <select name="smoking">
      <? foreach($this->socials['smoking'] as $k=>$v){?>
      <option  <? if($this->user["social"]["smoking"]==$k){?>selected="selected"<? }?> value="<?=$k?>">
      <?=$v?>
      </option>
      <? }?>
    </select>
  </dd>
  <dt>
    <label for="drinking"> drinkin for me:</label>
  </dt>
  <dd>
    <select name="drinking">
      <? foreach($this->socials['drinking'] as $k=>$v){?>
      <option  <? if($this->user["social"]["drinking"]==$k){?>selected="selected"<? }?> value="<?=$k?>">
      <?=$v?>
      </option>
      <? }?>
    </select>
  </dd>
  <dt>
    <label for="pets"> my view about pets:</label>
  </dt>
  <dd>
    <select name="pets">
      <? foreach($this->socials['pets'] as $k=>$v){?>
      <option  <? if($this->user["social"]["pets"]==$k){?>selected="selected"<? }?> value="<?=$k?>">
      <?=$v?>
      </option>
      <? }?>
    </select>
  </dd>
  <dt>
    <label for="living"> i m living:</label>
  </dt>
  <dd>
    <select name="living">
      <? foreach($this->socials['living'] as $k=>$v){?>
      <option  <? if($this->user["social"]["living"]==$k){?>selected="selected"<? }?> value="<?=$k?>">
      <?=$v?>
      </option>
      <? }?>
    </select>
  </dd>
  <dt>
    <label for="hometown"> my hometown:</label>
  </dt>
  <dd>
    <input type="text" value="<?=$this->user["social"]["hometown"]?>" name="hometown"/>
  </dd>
  <dt>
    <label for="webpage"> my webpage:</label>
  </dt>
  <dd>
    <input type="text" value="<?=$this->user["social"]["webpage"]?>" name="webpage"/>
  </dd>
  <dt>
    <label for="aboutMe"> about me:</label>
  </dt>
  <dd>
    <textarea name="aboutMe"><?=$this->user["social"]["aboutMe"]?></textarea>
  </dd>
  <dt>
    <label for="passions"> my passions are:</label>
  </dt>
  <dd>
    <textarea name="passions"><?=$this->user["social"]["passions"]?></textarea>
  </dd>
  <dt>
    <label for="sports"> sports i like:</label>
  </dt>
  <dd>
    <textarea name="sports"><?=$this->user["social"]["sports"]?></textarea>
  </dd>
  <dt>
    <label for="activities"> activities:</label>
  </dt>
  <dd>
    <textarea name="activities"><?=$this->user["social"]["activities"]?></textarea>
  </dd>
  <dt>
    <label for="books"> books i like:</label>
  </dt>
  <dd>
    <textarea name="books"><?=$this->user["social"]["books"]?></textarea>
  </dd>
  <dt>
    <label for="music"> music i listen:</label>
  </dt>
  <dd>
    <textarea name="music"><?=$this->user["social"]["music"]?></textarea>
  </dd>
  <dt>
    <label for="tvShows"> tv shows i watch:</label>
  </dt>
  <dd>
    <textarea name="tvShows"><?=$this->user["social"]["tvShows"]?></textarea>
  </dd>
  <dt>
    <label for="movies"> movies i can see again:</label>
  </dt>
  <dd>
    <textarea name="movies"><?=$this->user["social"]["movies"]?></textarea>
  </dd>
  <dt>
    <label for="cuisines"> cuisines:</label>
  </dt>
  <dd>
    <textarea name="cuisines"><?=$this->user["social"]["cuisines"]?></textarea>
  </dd>
  <dt>&nbsp;</dt>
  <dd><a href="javascript:;"><img src="<?=IMAGES?>update.gif" border="0" /></a></dd>
</dl>
