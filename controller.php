<?php
include 'func.php';
include 'conf.php';

$cache = new \Memcached();	
$cache->addServer($host, $port);	

$result = '';
//DELETE
if (isset($_REQUEST['del']) && !empty($_REQUEST['del'])) {
	$extra = '';
	if ($delete_tags === true && strpos($_REQUEST['del'], 'tag!') === 0) {
		$get = $cache->get($_REQUEST['del']);
		if (is_array($get)) {
			$extra .= '<p>This key was detected as a <b>tag</b>, we tried to delete also the following keys:<ul>';
			foreach ($get as $key) {
				$r2 = $cache->delete($key);
				if ($r2) {
					$color = 'green';
				} else {
					$color = 'red';
				}
				$extra .= '<li><span style="color:'.$color.'">'.$key.'</li>';
			}			
			$extra .= '</ul></p>';
		}
	}	
	$r = $cache->delete($_REQUEST['del']);	
	if ($r) {
		$result = '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> The key \''.$_REQUEST['del'].'\' was deleted succesfully.'.$extra.'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
	} else {
		$result = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> We weren\'t able to delete the key \''.$_REQUEST['del'].'\'. Error Result Code '.$r->getResultCode().'. '.$extra.'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
	}
//INFO	
} elseif (isset($_REQUEST['info']) && !empty($_REQUEST['info'])) {
	$r = $cache->get($_REQUEST['info']);	
	if ($r) {
		$result = '<div class="alert alert-info alert-dismissible fade show" role="alert">
  <h4>'.$_REQUEST['info'].'</h4><textarea id="textarea" rows="20" style="width: 100%;background-color:black;color:white">'.print_r($r,true).'</textarea>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
	} else {
		$result = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> We couldn\'t get the key \''.$_REQUEST['info'].'\' Error Result Code '.$r->getResultCode().'.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
	}
}

//GET ALL KEYS
$keys = getMemcachedKeys($host,$port);