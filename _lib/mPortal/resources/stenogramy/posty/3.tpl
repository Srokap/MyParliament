{assign var="meta" value=$t.meta}
<p class="intro">Zakończyło się posiedzenie Sejmu:</p>
<a class="ramka" href="/posiedzenia/{$t.c_id}/moi_poslowie">

  <div class="aoverflow">
	  <p class="tytul lalign lfloat">{$t.tytul}</p>
	  <p class="data ralign rfloat">{$meta.data_tytul}</p>
	</div>
	
	
	<div class="meta">
	  
	  <div class="meta_table">
	    <div class="row">
	      {if $meta.wystapienia ne '0'}
		      <p class="msg">{$meta.wystapienia|dopelniaczb:'poseł zabrał głos':'posłów zabrało głos':'posłów zabrało głos'}.</p>
		    {/if}
	    </div>
	    <div class="row">
	      {if $meta.nieobecnosci ne '0'}
		      <p class="msg">{$meta.nieobecnosci|dopelniaczb:'poseł był nieobecny':'posłów było nieobecnych':'posłów było nieobecnych'}.</p>
		    {/if}
	    </div>
	    <div class="row">
	      {if $meta.bunty ne '0'}
		      <p class="msg">{$meta.bunty|dopelniaczb:'poseł zbuntował się przeciwko swojemu klubowi':'posłów zbuntowało się przeciwko swoim klubom':'posłów zbuntowało się przeciwko swoim klubom'}.</p>
		    {/if}
	    </div>
	    <div class="row button">
	      <p>więcej informacji &raquo;</p>
	    </div>
	  </div>
	  
	</div>
	
	
	
	
</a>