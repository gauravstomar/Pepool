<? extract($this->user);?>
<div class="top">
    <form id="userSearch">
    <p>
        <label><span>First Name</span><input name="fname" type="text" size="12" /></label>
        <label><span>Last Name</span><input name="lname" type="text" size="12" /></label>
        <label><span>Email</span><input name="email" type="text" size="12" /></label>
    </p>
    <p class="hyper">
    	<label><span>Country</span>
        <select name="country">
            <option value="" >Select Country</option>
            <? foreach($this->country as $k=>$v){?>
            <option value="<?=$k?>"><?=$v?></option>
            <? }?>
        </select></label>
        <label><span>State</span>
        <input name="state" type="text" size="12" /></label>
        <label><span>City/ Village</span>
        <input name="city" type="text" size="12" /></label>
    </p>
    <p class="hyper">
        <label><span>Gender</span>
        <select name="gender" id="gender" title="Please choose your gender.">
            <option value="">Any</option>
            <option value="F">Female</option>
            <option value="M">Male</option>
        </select></label>
		<label><span>Min Age</span>
        <select name="minAge">
            <option value="">Select </option>
            <? for($i=9;$i<99;$i++){?>
            <option value="<?=$i?>"><?=$i?></option>
            <? }?>
        </select>
        </label>
        <label><span>Max Age</span>
        <select name="maxAge">
            <option value="">Select </option>
            <? for($i=99;$i>9;$i--){?>
            <option value="<?=$i?>"><?=$i?></option>
            <? }?>
        </select>
        </label>
    </p>
    </form>
</div>
<div class="bot"><a href="javascript:;" class="reset wa fn">[Reset]</a> <a href="javascript:;" class="hyper wa fn"> Advance Search </a></div>
<img src="<?=IMAGES?>search.gif" id="sButton" alt="search" />
<div id="searchResult"></div>
    
