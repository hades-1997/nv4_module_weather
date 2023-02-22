<!-- BEGIN: main -->
<div id="users">
	<form action="{FORM_ACTION}" method="post">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
				<colgroup>
					<col style="width: 260px" />
					<col/>
				</colgroup>
				<tfoot>
					<tr>
						<td colspan="2"><input type="hidden" name="save" value="1">
							<input type="submit" value="{LANG.save}" class="btn btn-primary" />
						</td>
					</tr>
				</tfoot>
				<tbody>
					<tr>
						<td>{LANG.city}</td>
						<td>
						<select name="viewcity" class="form-control w200">
							<!-- BEGIN: city -->
							<option value="{CITY.id}" {CITY.selected}>{CITY.title}</option>
							<!-- END: city -->
						</select></td>
					</tr>
					<tr>
						<td>{LANG.api_weather}</td>
						<td>
							<input class="form-control w200" name="token" value="{DATA.token}" />
							<span class="help-block">{LANG.config_token_weather_note}</span>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</form>
</div>
<!-- END: main -->