<?php include 'head.php' ?>

<body class="">

	<!-- Main Container Fluid -->
	<div class="container-fluid fluid menu-left">

		<!-- Top navbar -->
		<?php include 'top-nav.php' ?>
		<!-- Top navbar END -->


		<!-- Sidebar menu & content wrapper -->
		<div id="wrapper">

			<!-- Sidebar Menu -->
			<?php include 'menu-left.php' ?>
			<!-- // Sidebar Menu END -->


			<!-- Content -->
			<!-- <div class="span-19"> -->
			<div id="content">
				<ul class="breadcrumb">
					<li><a href="/admin/index.php">หน้าหลัก</a></li> » <li><a href="/admin/index.php/grouptesting/index">ระบบชุดข้อสอบบทเรียนออนไลน์</a></li> » <li>เพิ่มชุดข้อสอบอบรมออนไลน์</li>
				</ul><!-- breadcrumbs -->
				<div class="separator bottom"></div>


				<!-- innerLR -->
				<div class="innerLR">
					<div class="widget widget-tabs border-bottom-none">
						<div class="widget-head">
							<ul>
								<li class="active">
									<a class="glyphicons edit" href="#account-details" data-toggle="tab">
										<i></i>เพิ่มชุดข้อสอบออนไลน์ </a>
								</li>
							</ul>
						</div>
						<div class="widget-body">
							<div class="form">
								<form enctype="multipart/form-data" id="news-form" action="/admin/index.php/Grouptesting/create" method="post">
									<p class="note">ค่าที่มี <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span> จำเป็นต้องใส่ให้ครบ</p>
									<div class="row">
										<label for="Grouptesting_lesson_id" class="required">ชื่อบทเรียนออนไลน์ <span class="required">*</span></label> <select class="span8" name="Grouptesting[lesson_id]" id="Grouptesting_lesson_id">
											<option value="">--- กรุณาเลือกบทเรียน ---</option>
											<option value="92">Mono Laser Technology</option>
											<option value="98">Direct Thermal and Thermal Transfer</option>
											<option value="99">บทเรียนที่ 1 Editing text elephant </option>
											<option value="138">บทเรียนที่ 2 Edit basic text</option>
											<option value="139">บทเรียนที่ 3 Create Floral Lines</option>
											<option value="140">บทเรียนที่ 4 Transforming Text</option>
											<option value="141">บทเรียนที่ 5 Template Feature</option>
											<option value="142">บทเรียนที่ 6 Manual Punch for Logo Making </option>
											<option value="143">บทเรียนที่ 7 Pencil Tool Freehand Tool </option>
											<option value="144">บทเรียนที่ 8 Remove Overlap</option>
											<option value="145">บทเรียนที่ 9 Remove Parts of Design Split stitch Tool </option>
											<option value="146">ทำข้อสอบ การมใช้งานโปรแกรม PE-Design Next</option>
											<option value="158">ASC Portal</option>
											<option value="166">เครื่องพิมพ์ Color Laser Technology</option>
											<option value="168">บทที่ 1 เครื่องพิมพ์ Mono Laser Technology</option>
											<option value="169">ทำความรู้จักระบบ New Bsis</option>
											<option value="170">วิธีการแก้เมื่อด้ายบนด้ายล่างขาดของจักร VR Series</option>
											<option value="171">วิธีแก้ปัญหาเมื่อกระกระด้ายเข้ากระสวยไม่เต็ม</option>
											<option value="172">การเย็บแบบ Blind Stitch</option>
											<option value="173">การแก้ไขปัญหาเสียงดังจากกระสวยจักร รุ่น NV750</option>
											<option value="174">การเย็บด้าย 3 เส้น ของจักรโผ้ง รุ่น 2104D</option>
											<option value="175">วิธีเย็บโพ้งเก็บริม 3 เส้น </option>
											<option value="176">วิธีซ่อม อาการสนเข็มไม่ได้ รุ่น NV-750E</option>
											<option value="177">การร้อยด้ายจักรโพ้ง</option>
											<option value="179">วิธีเย็บโพ้งเก็บริม 3 เส้นแบบม้วน</option>
											<option value="180">เสียงดังเกิดจากตีนผีปัก </option>
											<option value="181">การร้อยด้าย VR</option>
											<option value="182">ส่วนประกอบของจักรโพ้ง4324D</option>
											<option value="183">ปัญหาด้ายบนตึงด้ายล่างหย่อนของจักรปัก</option>
											<option value="184">การเย็บ Rolled Hem แบบ Normal thread</option>
											<option value="185">การเย็บแบบ Tapping Foot</option>
											<option value="186">วิธี่การใช้ตีนเย็บผ้า piping foot ของปักโพ้ง </option>
											<option value="187">การปรับความตึงด้ายของจักรเย็บผ้า</option>
											<option value="188">การปรับเซ็ทค่า Picker ในจักร PR Series</option>
											<option value="189">การแก้ไขปัญหาลายผิดของจักรคอม รุ่น NV Series </option>
											<option value="190">บทที่ 1. แนะนำผลิตภัณท์ (Product Introduce)</option>
											<option value="191">บทที่ 2. Specification &amp; Outline</option>
											<option value="192">บทที่ 3. การติดตั้ง Hardware และ Software</option>
											<option value="193">บทที่ 4.1 หลักการทำงานของอุปกรณ์ Scanner</option>
											<option value="194">บทที่ 4.2 หลักการทำงานของอุปกรณ์ Printer</option>
											<option value="195">บทที่ 5. สิ่งทีเพิ่มเข้ามาใน Series 11</option>
											<option value="196">บทที่ 1. Product Line Up &amp; Specifications</option>
											<option value="197">บทที่ 2. การพัฒนาและการเปลี่ยนแปลงของผลิตภัณท์</option>
											<option value="198">บทที่ 3. สิ่งที่ควรรู้หลังจากเปลี่ยนมาใช้ระบบ Tank Unit</option>
											<option value="199">บทที่ 4. ปัญหาและวิธีแก้ไข</option>
											<option value="200">บทที่ 1. Product Line Up &amp; Specifications.</option>
											<option value="201">บทที่ 2. Product Improvements</option>
											<option value="202">บทที่ 3. Usability improvements</option>
											<option value="204">บทที่ 4. Service Topics.</option>
											<option value="205">บทที่ 5. Special Notes.</option>
											<option value="206">บทที่ 1. แนะนำผลิตภัณท์เบื้องต้น</option>
											<option value="207">บทที่ 2 คุณสมบัติและข้อมูลตัวเครื่อง</option>
											<option value="208">บทที่ 3 การติดตั้งเครื่องครั้งแรก</option>
											<option value="209">บทที่ 4. เนื้อหาอธิบายส่วนทฤษฎี</option>
											<option value="210">1.P-Touch Editor Overview</option>
											<option value="212">บทที่ 6. Disasembly</option>
											<option value="213">บทที่ 5. การถอดประกอบเครื่อง</option>
											<option value="215">การเข้าใช้งานระบบ Bsis</option>
											<option value="216">การเช็คประวัติลูกค้าและทำการสร้างประวัติ</option>
											<option value="219">การเปิดงานใหม่</option>
											<option value="220">การบริหารอะไหล่</option>
											<option value="221">การเคลมค่าบริการ</option>
											<option value="222">บทที่ 6 ขั้นตอนการถอดประกอบเครื่องพิมพ์ (Brother Color LED)</option>
											<option value="223">บทที่ 1 แนะนำผลิตภัณฑ์เบื้องต้น (Brother Color LED)</option>
											<option value="224">บทที่ 2.คุณสมบัติและข้อมูลตัวเครื่อง (Brother Color LED)</option>
											<option value="225">บทที่ 3. หลักการทำงานและทฤษฏี (Brother Color LED)</option>
											<option value="226">บทที่ 4.ขั้นตอนตรวจเช็คตามระยะเวลา (Brother Color LED)</option>
											<option value="227">บทที่ 5. การแก้ปัญหาเบื้องต้น (Brother Color LED)</option>
											<option value="229">บทที่ 1 แนะนำผลิตภัณฑ์เบื้องต้น (Brother Mono Laser)</option>
											<option value="230">บทที่ 2.คุณสมบัติและข้อมูลตัวเครื่อง (Brother Mono Laser)</option>
											<option value="231">บทที่ 3. หลักการทำงานและทฤษฏี (Brother Mono Laser)</option>
											<option value="232">บทที่ 4.ขั้นตอนตรวจเช็คตามระยะเวลา (Brother Mono Laser)</option>
											<option value="233">บทที่ 5. การแก้ปัญหาเบื้องต้น (Brother Mono Laser)</option>
											<option value="234">บทที่ 6 ขั้นตอนการถอดประกอบเครื่องพิมพ์ (Brother Mono Laser )</option>
											<option value="244">Module II : Brother (นักบริการมืออาชีพ)</option>
											<option value="245">การเตรียมความพร้อมเพื่อการบริการ</option>
											<option value="246">การต้อนรับ แบบ Brother</option>
											<option value="247">Brother Service Identity</option>
											<option value="248">การให้บริการทางโทรศัพท์</option>
											<option value="249">การให้บริการทางโทรศัพท์ (ต่อ)</option>
											<option value="250">การบริการให้ข้อมูลแก่ลูกค้า</option>
											<option value="251">บริการรับเครื่องเข้าซ่อม</option>
											<option value="252">บริการรับเครื่องเข้าซ่อม (ต่อ)</option>
											<option value="253">บริการแจ้งผลความคืบหน้า หรือ ผลการซ่อม</option>
											<option value="254">บริการส่งมอบเครื่องภายหลังการซ่อม</option>
											<option value="255">บริการซ่อมนอกสถานที่</option>
											<option value="258">ที่มาและความสำคัญของหลักสูตร Brother Service Exellence </option>
											<option value="259">ทักษะต่างๆที่เราจะเรียนรู้ไปพร้อมกัน </option>
											<option value="260">ตอบโจทย์ความต้องการและความคาดหวังของลูกค้า Brother </option>
											<option value="261">ครองใจลูกค้าด้วย “บุคลิกภาพการบริการ Brother”</option>
											<option value="262">Concern (ห่วงใย)</option>
											<option value="263">Ability ( มีฝีมือ )</option>
											<option value="264">Responsive (ฉับไว)</option>
											<option value="265">Engage (ใส่ใจ)</option>
											<option value="266">Reliable (วางใจ)</option>
											<option value="267">NV950</option>
											<option value="268">VDO หลักการของการเย็บผ้า</option>
											<option value="269">การตั้งค่าจักร NV950</option>
											<option value="270">ถอดประกอบจักร NV950</option>
											<option value="271">Mobile printing</option>
											<option value="272">2.Download and Install P-Touch Editor</option>
											<option value="273">3.Create Label from Template</option>
											<option value="274">4.Create Label by own design</option>
											<option value="275">5.Create Label from Database</option>
											<option value="276">6.Cutting label in each option</option>
											<option value="277">การแก้ไขปัญหาจักร VR ปุ่มนิรภัยถูกปิด และการหยอดน้ำมัน VR</option>
											<option value="278">ตำแหน่งการปรับสายพานจักร VR</option>
											<option value="279">การใช้ Cap Frame เบี้ยงต้น</option>
											<option value="280">การเปลี่ยนที่สนเข็ม GS2700</option>
											<option value="281">การแก้ไข hand weel หมุนไม่ได้</option>
											<option value="283">Brother Meter Read Tool</option>
											<option value="284">บทที่ 1 แนะนำผลิตภัณฑ์เบื้องต้น (Brother Mono Laser for ELL Series)</option>
											<option value="285">บทที่ 2.คุณสมบัติและข้อมูลตัวเครื่อง (Brother Mono Laser for ELL Series)</option>
											<option value="286">บทที่ 3. หลักการทำงานและทฤษฏี (Brother Mono Laser for ELL Series)</option>
											<option value="287">บทที่ 4.ขั้นตอนตรวจเช็คตามระยะเวลา (Brother Mono Laser for ELL Series)</option>
											<option value="288">บทที่ 5. การแก้ปัญหาเบื้องต้น (Brother Mono Laser for ELL Series)</option>
											<option value="289">บทที่ 6 ขั้นตอนการถอดประกอบเครื่องพิมพ์ (Brother Mono Laser for ELL Series )</option>
											<option value="290">บทที่ 5. Special Notes.</option>
											<option value="291">บทที่ 4. Service Topics.</option>
											<option value="292">บทที่ 3. Usability improvements.</option>
											<option value="293">บทที่ 2. Product Improvements.</option>
											<option value="294">บทที่ 1. Product Line Up &amp; Specifications A3 Tank</option>
											<option value="300">บทที่ 1 แนะนำผลิตภัณฑ์เบื้องต้น (Brother Color LED for ECL Series)</option>
											<option value="301">บทที่ 2.คุณสมบัติและข้อมูลตัวเครื่อง (Brother Color LED for ECL Series)</option>
											<option value="302">บทที่ 3. หลักการทำงานและทฤษฏี (Brother Color LED for ECL Series)</option>
											<option value="303">บทที่ 4.ขั้นตอนตรวจเช็คตามระยะเวลา (Brother Color LED for ECL Series)</option>
											<option value="304">บทที่ 5. การแก้ปัญหาเบื้องต้น (Brother Color LED for ECL Series)</option>
											<option value="305">บทที่ 6 ขั้นตอนการถอดประกอบเครื่องพิมพ์ (Brother Color LED for ECL Series )</option>
											<option value="306">บนที่ 7. แบบทดสอบ ECL-SEries ภาคทฏษฎี 20 ข้อ (Brother Color LED for ECL Series )</option>
											<option value="307">บทที่ 7. แบบทดสอบหลังจบหลักสูตร (Brother Mono Laser ELL Series)</option>
											<option value="309">บทที่ 1 รู้จักกับเครื่องพิมพ์ผ้าระบบดิจิทัล GTX-422</option>
											<option value="310">บทที่ 2 การติดตั้งและการตั้งค่าเครื่องพิมพ์ผ้าระบบดิจิตอล GTX-422</option>
											<option value="311">บทที่ 3. การออกแบบและการพิมพ์ลงบนผ้าของเครื่องพิมพ์ผ้าระบบดิจิตอล GTX-422</option>
											<option value="312">บทที่ 4 การบำรุงรักษาของเครื่องพิมพ์ผ้าระบบดิจิตอล GTX-422</option>
											<option value="313">บทที่ 5. แบบทดสอบหลังจบหลักสูตร (GTX-422)</option>
											<option value="315">บทที่ 6. Disasembly</option>
											<option value="321">บทที่ 7 ทดสอบ (หลังเรียน) 20 คะแนน</option>
											<option value="322">บทที่ 1 Download and Start Brother iPrint and Scan</option>
											<option value="323">บทที่ 2 Scan a document using Brother iPrint and Scan</option>
											<option value="324">บทที่ 3 Configure the scan button setting and scan settings</option>
											<option value="325">บทที่ 4 Application Setting</option>
											<option value="326">บทที่ 5. แบบทดสอบหลังจบหลักสูตร (ฺBrother iprint and scan)</option>
											<option value="327">บทที่ 1 แนะนำผลิตภัณฑ์เบื้องต้น (Brother Scanner for ADS2 Series)</option>
											<option value="328">บทที่ 2.คุณสมบัติและข้อมูลตัวเครื่อง (Brother Scanner for ADS2 Series)</option>
											<option value="329">บทที่ 3. หลักการทำงานและทฤษฏี (Brother Scanner for ADS2 Series)</option>
											<option value="330">บทที่ 4.ขั้นตอนตรวจเช็คตามระยะเวลา (Brother Scanner for ADS Series)</option>
											<option value="331">บทที่ 5 ขั้นตอนการถอดประกอบเครื่องสแกน (Brother Scanner for ADS2 Series )</option>
											<option value="332">บนที่ 6. แบบทดสอบ ADS2 Series ภาคทฏษฎี 10 ข้อ</option>
											<option value="333">บทที่ 1 Overview about Light Solution &amp;amp; What’s Barcode Utility</option>
											<option value="334">บทที่ 2 How To Setup</option>
											<option value="335">บทที่ 3. แบบทดสอบหลังจบหลักสูตร (ฺBarcode Utility Program)</option>
											<option value="336">Type of wi-fi</option>
											<option value="337">ภาษาเครื่องพิมพ์ ( Emulator)</option>
											<option value="338">Part 1: แนะนำโปรแกรม BR-Admin Professional 4</option>
											<option value="339">Part 2 : ขั้นตอนการ download และ ติดตั้ง</option>
											<option value="340">Part 3 : การใช้งานในส่วน Device</option>
											<option value="341">Part 4 : การใช้งานในส่วน Application Settings</option>
											<option value="342">Part 5 : การใช้งานในส่วน Tasks</option>
											<option value="343">บทที่1 Troubleshooting (Hardware)</option>
											<option value="344">บทที่2 Troubleshooting (Software)</option>
											<option value="345">บทที่3 ขั้นตอนการแจ้งซ่อมงานกับบราเดอร์ฯ</option>
											<option value="346">บทที่4 แบบทดสอบ (CRG Project)</option>
											<option value="347">Strategic Thinking</option>
											<option value="348">ทำความรู้จักผลิตภัณฑ์ Brother Care Pack </option>
											<option value="349">EP1 : ทำความรู้จักผลิตภัณฑ์ Brother Care Pack </option>
											<option value="350">EP2 : เทคนิคการนำเสนอขายบริการเสริม Brother Care Pack </option>
											<option value="351">EP3 : นำเสนอ Extend Warranty ในกรณีขายพร้อมเครื่องใหม่ (มีส่วนลด)</option>
											<option value="352">EP3 :นำเสนอ Extend Warranty ในกรณีขายพร้อมเครื่องใหม่โดยไมมีส่วนลด</option>
											<option value="353">EP3 : นำเสนอ Extend Warranty ในกรณีลูกค้าสนใจซื้อ </option>
											<option value="354">EP3 : นำเสนอ Extend Warranty ในกรณีลูกค้าลังเลในการซื้อ</option>
											<option value="355">EP3 : นำเสนอ Extend Warranty ในกรณีลูกค้าไม่สนใจซื้อ </option>
											<option value="356">EP4: Onsite Service กรณีแนะนำพร้อมเครื่องใหม่ </option>
											<option value="357">EP4: Onsite Service กรณีแนะนำพร้อมเครื่องที่อยู่ในระยะการรับประกัน</option>
											<option value="358">EP5: Installation Service :แนะนำการติดตั้งเครื่อง</option>
											<option value="359">EP:5 Maintenance Agreement Service : แนะนำการตรวจเช็คบำรุงรักษารายปี</option>
											<option value="361">บทที่ 1 แนะนำผลิตภัณฑ์เบื้องต้น</option>
											<option value="362">บทที่ 2 การใช้งานเบื้องต้นและขั้นตอนการตรวจเช็คตามระยะเวลา</option>
											<option value="363">บทที่ 3 การแก้ไขปัญหาเบื้องต้นและข้อมูลสำหรับการแจ้งซ่อม</option>
											<option value="364">GTX</option>
											<option value="365">Printer_Part1</option>
											<option value="366">Printer_Part2</option>
											<option value="367">L&amp;amp;M</option>
											<option value="368">Scanner</option>
											<option value="369">บทที่4 แบบทดสอบ (ธกส. HiQ)</option>
											<option value="370">ทดสอบระบบ ๅ</option>
											<option value="371">บทที่ 1 แนะนำผลิตภัณฑ์ใหม่และข้อมูลจำเพาะ (Product Line up and Specification)</option>
											<option value="372">บทที่ 2 การเปลี่ยนแปลงและปรับปรุงของผลิตภัณฑ์ Whats New Product Improvement</option>
											<option value="373">บทที่ 3 การเปลี่ยนแปลงในส่วนการใช้งาน What is New in Basic Operation</option>
											<option value="374">บทที่ 4 การเปลี่ยนแปลงใน Maintenance Mode (What is New in Maintenance Mode)</option>
											<option value="375">บทที่ 5 การถอดประกอบเครื่องพิมพ์ ( How to Disassemble Machines )</option>
											<option value="378">บทที่ 1 แนะนำผลิตภัณฑ์ และ บทที่ 2 คุณสมบัติและข้อมูลของตัวเครื่อง</option>
											<option value="379">บทที่ 3 ทฤษฏีและหลักการทำงาน</option>
											<option value="380">บทที่ 4 ขั้นตอนตรวจเช็คตามระยะเวลา</option>
											<option value="381">บทที่ 5 การแก้ปัญหาเบื้องต้น</option>
											<option value="382">บทที่ 6 การถอดประกอบเครื่องพิมพ์ฉลาก PT-E850TKW</option>
											<option value="383">บทที่ 1. แนะนำผลิตภัณฑ์ จักรเย็บผ้า GS2700</option>
											<option value="384">บทที่ 2. การใช้งานเบื้องต้น </option>
											<option value="385">บทที่ 2.(ต่อเนื่อง) ส่วนประกอบของเครื่อง </option>
											<option value="386">บทที่ 3.การถอด/ประกอบ เครื่อง GS2700</option>
											<option value="388">บทที่ 4.การปรับตั้งค่า ใช้งาน (Adjustment)</option>
											<option value="389">บทที่ 5 แบบทดสอบ GS2700 ภาคทฏษฎี 10 ข้อ</option>
											<option value="390">บทที่ 1. แนะนำผลิตภัณฑ์ จักรเย็บผ้า NV-180</option>
											<option value="391">บทที่ 2.1 การใช้งานเบื้องต้น </option>
											<option value="392">บทที่ 2.2 การใช้งานเบื้องต้น (VDO การใช้งาน)</option>
											<option value="393">บทที่ 3.การถอด/ประกอบ เครื่อง NV-180</option>
											<option value="394">บทที่ 4.1 การปรับตั้งค่า ใช้งาน (Adjustment) NV-180</option>
											<option value="395">บทที่ 4.2 การปรับตั้งค่า ใช้งาน (Adjustment) NV-180 (VDO การปรับตั้งค่า)</option>
											<option value="396">บทที่ 5. การปรับตั้งค่าทั้งหมด NV-180</option>
											<option value="397">บทที่ 6 แบบทดสอบ NV-180 ภาคทฏษฎี 10 ข้อ</option>
											<option value="398">บทที่ 1. แนะนำผลิตภัณฑ์ เครื่องพิมพ์ฉลาก รุ่น TD-4550DNWB</option>
											<option value="399">บทที่ 2. การใช้งานเบื้องต้น เครื่องพิมพ์ฉลากรุ่น TD-4550DNWB</option>
											<option value="400">บทที่ 3. ทฤษฎีและหลักการทำงานของเครื่องพิมพ์ฉลาก รุ่น TD-4550DNWB</option>
											<option value="401">บทที่ 4. ขั้นตอนการตรวจเช็คตามระยะเวลาของเครื่องพิมพ์ฉลากรุ่น TD-4550DNWB</option>
											<option value="402">บทที่ 5. การแก้ไขปัญหาเบื้องต้นสำหรับเครื่องพิมพ์ฉลากรุ่น TD-4550DNWB</option>
											<option value="403">บทที่ 6. ขั้นตอนการถอดประกอบเครื่องพิมพ์ฉลาก รุ่น TD-4550DNWB</option>
											<option value="404">บทที่ 7. แบบทดสอบ 10 ข้อ สำหรับเครื่องพิมพ์ฉลากรุ่น TD-4550DNWB</option>
											<option value="406">Online Marketing Day 1 Part1 </option>
											<option value="407">Online Marketing Day 1 Part2</option>
											<option value="408">Online Marketing Day 1 Part3</option>
											<option value="409">Online Marketing Day 1 Part4</option>
											<option value="410">Online Marketing Day 1 Part5</option>
											<option value="411">Online Marketing Day 2 Part1</option>
											<option value="412">Online Marketing Day 2 Part2</option>
											<option value="413">Online Marketing Day 2 Part3</option>
											<option value="414">Online Marketing Day 2 Part4</option>
											<option value="415">Online Marketing Day 2 Part4</option>
											<option value="416">Online Marketing Day 2 Part5</option>
											<option value="417">Online Marketing Day 3 Part1</option>
											<option value="418">Online Marketing Day 3 Part2</option>
											<option value="419">Online Marketing Day 3 Part3</option>
											<option value="420">Online Marketing Day 3 Part4</option>
											<option value="421">Online Marketing Day 3 Part5</option>
											<option value="422">แนะนำผลิตภัณฑ์ BMB เบื้องต้น</option>
											<option value="423">บทที่ 1. หลักสูตรแนะนำผลิตภัณฑ์ GTX เบื้องต้น (ช่วงที่ 1)</option>
											<option value="424">บทที่ 2. หลักสูตรแนะนำผลิตภัณฑ์ GTX เบื้องต้น (ช่วงที่ 2)</option>
											<option value="425">บทที่ 3. การติดตั้งและบำรุงรักษผลิตภัณฑ์ GTX เบื้องต้น </option>
											<option value="426">Namwantest1</option>
											<option value="428">Namwantest2</option>
											<option value="431">ทดสอบ api</option>
											<option value="432">ทีเทส</option>
											<option value="433">tee test</option>
										</select> <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>
										<div class="error help-block">
											<div class="label label-important" id="Grouptesting_lesson_id_em_" style="display:none"></div>
										</div>
									</div>

									<div class="row">
										<label for="Grouptesting_group_title" class="required">ชื่อชุด <span class="required">*</span></label> <input size="60" maxlength="250" class="span8" name="Grouptesting[group_title]" id="Grouptesting_group_title" type="text"> <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>
										<div class="error help-block">
											<div class="label label-important" id="Grouptesting_group_title_em_" style="display:none"></div>
										</div>
									</div>
									<div class="row buttons">
										<button class="btn btn-primary btn-icon glyphicons ok_2"><i></i>บันทึกข้อมูล</button>
									</div>
								</form>
							</div><!-- form -->
						</div>
					</div>
				</div>
				<!-- END innerLR -->
				<div id="sidebar">
				</div><!-- sidebar -->
			</div>
			<!-- </div> -->
			<!-- <div class="span-5 last"> -->
			<!-- </div> -->
			<!-- // Content END -->

		</div>
		<div class="clearfix"></div>
		<!-- // Sidebar menu & content wrapper END -->

		<div id="footer" class="hidden-print">

			<!--  Copyright Line -->
			<div class="copy">© 2023 - All Rights Reserved.</a></div>
			<!--  End Copyright Line -->

		</div>
		<!-- // Footer END -->

	</div>

</body>

<?php include 'footer.php' ?>