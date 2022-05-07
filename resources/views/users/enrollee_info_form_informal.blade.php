<div class="col-md-6">
		<div class="form-group">
			 <label for="first_name">Premium Pin  <span class="asterik asterik_first_name">*</span> </label>
			<p><input type="text" class="form-control" name="pin" onkeyup="restrict('pin')" value="" id="pin" onblur="handleAsterick(this.id, 3, true)" placeholder="pin" required=""></p>
	
		</div>
		
	</div>
	
	<div class="col-md-6">
		<div class="form-group">
			  <label for="surname">Serial Number<span class="asterik asterik_other_name"></span></label>
			<p><input type="text" class="form-control" name="serial_no" onkeyup="restrict('serial_no')" value="" id="serial_no" placeholder="Serial Number" required=""></p>
		</div>
		
	</div>
	
	
	<div class="col-md-6">
		<div class="form-group">
			 <label for="first_name">SURNAME  <span class="asterik asterik_first_name">*</span> </label>
			<p><input type="text" class="form-control" name="surname" onkeyup="restrict('surname')" value="" id="surname" onblur="handleAsterick(this.id, 3, true)" placeholder="Surname" required=""></p>
	
		</div>
		
	</div>
	
	<div class="col-md-6">
		<div class="form-group">
			  <label for="surname">FIRST NAME<span class="asterik asterik_other_name"></span></label>
			<p><input type="text" class="form-control" name="first_name" onkeyup="restrict('first_name')" value="" id="first_name" placeholder="First Name" required=""></p>
		</div>
		
	</div>
	
	<!-- column -->
	<div class="col-md-6">
		<div class="form-group">
			  <label for="marital_status"> OTHER NAME <span class="asterik asterik_marital_status">*</span></label>
			<p><input type="text" class="form-control" name="other_name" onkeyup="restrict('other_name')" value="" id="other_name" placeholder="Other Name"></p>
		
		</div>
		
	</div>
	
	<!-- column /-->
	<!-- column -->
		<div class="col-md-6">
			<div class="form-group">
			 <label for="first_name">Phone Number  <span class="asterik asterik_first_name">*</span> </label>
			<p><input type="text" class="form-control" name="phone_number" onkeyup="restrict('phone_number')" value="" id="phone_number" onblur="handleAsterick(this.id, 3, true)" placeholder="Phone Number" required=""></p>
	
		</div>
			
		</div>
		
		<!-- column /-->
		<!-- column -->
		<div class="col-md-6">
			<div class="form-group">
			 <label for="first_name">Email Address  <span class="asterik asterik_first_name">*</span> </label>
			<p><input type="text" class="form-control" name="email_address" onkeyup="restrict('email_address')" value="" id="email_address" onblur="handleAsterick(this.id, 3, true)" placeholder="Email Address" required=""></p>
	
		</div>
			
		</div>
		<div class="col-md-6">
			<div class="form-group">
				  <label for="sex">Gender <span class="asterik asterik_sex">*</span></label>
				<p>
					<select class="form-control" name="sex" id="sex" onblur="handleAsterick(this.id, 3, false)" required="">
						<option value=""> Select Sex </option>
						<option value="Male"> Male</option>
						<option value="Female"> Female</option>
					</select>
				</p>
			</div>
			
		</div>
		<div class="col-md-6">
			<div class="form-group">
				  <label for="marital_status">MARITAL STATUS <span class="asterik asterik_marital_status">*</span></label>
				<p>
					<select class="form-control" name="marital_status" id="marital_status" onblur="handleAsterick(this.id, 3, false)" onchange="handleAsterickSelect(this.id)" required="">
					
						<option value="Married"> Married</option>
						<option value="Single"> Single</option>
						<option value="Divorced"> Divorced</option>
						<option value="Separated"> Separated</option>
					</select>
				</p>
			</div>
			
		</div>
		<!-- column -->
			<div class="col-md-6">
				<div class="form-group">
					  <label for="occupation">Occupation <span class="asterik asterik_occupation">*</span></label>
					<p>
					<select class="form-control" onchange="loadLga(this.value)" id="occupation" name="occupation" required="">
								<option value="Farmer">Farmer</option>
								<option value="Business">Business</option>
								<option value="Others">Others</option>
					</select>
					</p>
				</div>
				
			</div>
			<!-- column -->
		<div class="col-md-6">
			<div class="form-group">
				  <label for="occupation">Address <span class="asterik asterik_occupation">*</span></label>
				<p>
				</p><p><input type="text" class="form-control" name="address" onkeyup="restrict('address')" value="" id="address" onblur="handleAsterick(this.id, 3, true)" placeholder=" Address" required=""></p>
	
				<p></p>
			</div>
			
		</div>
		<div class="col-md-6">
			<div class="form-group">
				  <label for="employer">Date of Birth  <span class="asterik asterik_employer">*</span></label>
				<p><input type="date" class="form-control" name="date_of_birth" id="date_of_birth" value="" placeholder="Date of Birth" onblur="handleAsterick(this.id, 3, true)"></p>
			</div>
			
		</div>