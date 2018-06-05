<div class="form-group" id="subcounty_select_div" style="display:none;">
  <label for="grp">Age group</label>
  <select type="text" name="grp" id="id-grp" class="form-control">
    <option value="1">15-19</option>
    <option value="2">20-24</option>
    <option value="3">25-30</option>
  </select>
  <script type="text/javascript">
      document.getElementById('select-input').addEventListener('change', function () {
          document.location = <?php $_SERVER["REQUEST_URI"]."&grp=" ?>$(this).val();
      });
  </script>

</div>