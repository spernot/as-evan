<?php

if (!defined('PUN')) exit;
define('PUN_QJ_LOADED', 1);
$forum_id = isset($forum_id) ? $forum_id : 0;

?>				<form id="qjump" method="get" action="viewforum.php">
					<div><label><span><?php echo $lang_common['Jump to'] ?><br /></span>
					<select name="id" onchange="window.location=('viewforum.php?id='+this.options[this.selectedIndex].value)">
						<optgroup label="Infos Générales">
							<option value="9"<?php echo ($forum_id == 9) ? ' selected="selected"' : '' ?>>Important</option>
							<option value="8"<?php echo ($forum_id == 8) ? ' selected="selected"' : '' ?>>Dates et programmes</option>
						</optgroup>
						<optgroup label="Questions et compléments">
							<option value="2"<?php echo ($forum_id == 2) ? ' selected="selected"' : '' ?>>Sotériologie</option>
							<option value="3"<?php echo ($forum_id == 3) ? ' selected="selected"' : '' ?>>Monde de la bible (géographie, histoire, pour comprendre la bible.)</option>
							<option value="4"<?php echo ($forum_id == 4) ? ' selected="selected"' : '' ?>>Méthode d’étude biblique</option>
							<option value="11"<?php echo ($forum_id == 11) ? ' selected="selected"' : '' ?>>le Pentateuque</option>
							<option value="5"<?php echo ($forum_id == 5) ? ' selected="selected"' : '' ?>>Histoire</option>
							<option value="6"<?php echo ($forum_id == 6) ? ' selected="selected"' : '' ?>>Foi biblique et foi catholique</option>
							<option value="7"<?php echo ($forum_id == 7) ? ' selected="selected"' : '' ?>>Doctrines et pratiques catholiques</option>
						</optgroup>
					</select></label>
					<input type="submit" value="<?php echo $lang_common['Go'] ?>" accesskey="g" />
					</div>
				</form>
