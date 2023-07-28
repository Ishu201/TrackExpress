<?php include('sidebar.php') ?>

<?php include('header.php') ?>


<?php
include('../models/Support_model.php');
$obj = new Support;
$result = $obj->get_list();
$result2 = $obj->get_list();
?>


<style>
	.chat-online {
		color: #34ce57
	}

	.chat-offline {
		color: #e4606d
	}

	.chat-messages {
		display: flex;
		flex-direction: column;
		max-height: 800px;
		overflow-y: scroll
	}

	.chat-message-left,
	.chat-message-right {
		display: flex;
		flex-shrink: 0
	}

	.rightChat {
		background-color: #7A9CB5 !important;
		color: whitesmoke !important;
	}

	.leftChat {
		background-color: #79AEB2 !important;
		color: whitesmoke !important;
	}

	.chat-message-left {
		margin-right: auto;

	}

	.chat-message-right {
		flex-direction: row-reverse;
		margin-left: auto;

	}

	.py-3 {
		padding-top: 1rem !important;
		padding-bottom: 1rem !important;
	}

	.px-4 {
		padding-right: 1.5rem !important;
		padding-left: 1.5rem !important;
	}

	.flex-grow-0 {
		flex-grow: 0 !important;
	}

	.border-top {
		border-top: 1px solid #dee2e6 !important;
	}

	.list-group-item:hover {
		background-color: #CDCCCB;
	}
</style>

<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left"><br>
				<p>Passenger Mgt / Customer Supports</p>
			</div>
			<!-- <a href="train_list.php" class="btn btn-sm btn-info" style="float:right;margin-top:10px;">Train List</a> -->
		</div>

		<div class="clearfix">
			<?php include('session_msg.php') ?>
		</div>

		<div class="row">
			<div class="col-md-12 col-sm-12  ">
				<div class="x_panel">
					<div class="x_title">
						<h2><b>Customer Support List</b></h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<!-- checking -->



						<main class="content">
							<div class="container p-0">
								<div class="card">
									<div class="row g-0">
										<div class="col-12 col-lg-5 col-xl-3 border-right">
											<div style="background-color:#f2f2f2;width:104%"><br><br><br></div>

											<?php
											while ($row_des = $result->fetch_array()) {
												$cusid = $row_des['customer_id'];
												$customer_name = $obj->customer($cusid);
												$customer_data = $customer_name->fetch_array();
												$name = $customer_data['cus_name'];
												$mail = $customer_data['usermail'];

												$msg_count = $obj->get_new_msg($cusid);

											?>
												<a href="../controllers/Support.php?id=<?php echo $cusid; ?>&status=read" class="list-group-item list-group-item-action border-0">
													<?php if ($msg_count > 0) {  ?><div class="badge bg-danger float-right" style="color:white;padding:5px"><?php echo $msg_count; ?></div><?php } ?>
													<div class="d-flex align-items-start">
														<img src="https://bootdey.com/img/Content/avatar/avatar5.png" class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40">
														<div class="flex-grow-1 ml-3">
															<b><?php echo $name; ?></b>
															<div class="small"><?php echo $mail; ?></div>
														</div>
													</div>
												</a>
											<?php } ?>

											<hr class="d-block d-lg-none mt-1 mb-0">
										</div>
										<div class="col-12 col-lg-7 col-xl-9">
											<div class="py-2 px-4 border-bottom d-none d-lg-block">
												<div class="d-flex align-items-center py-1">
													<div class="position-relative">
														<?php if (isset($_GET['id'])) {  ?>
															<img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
														<?php } else {
															echo '<br><br>';
														} ?>
													</div>
													<div class="flex-grow-1 pl-3">
														<strong>
															<?php if (isset($_GET['id'])) {
																$cid = $_GET['id'];
																$customer_name11 = $obj->customer($cusid);
																$customer_data11 = $customer_name11->fetch_array();
																echo $name = $customer_data11['cus_name'];
															} else {
																echo '<br><br>';
															} ?>
														</strong>
													</div>
												</div>
											</div>

											<div class="position-relative" id="custom-scroll" style="height:400px">
												<div class="chat-messages p-4" style="height:400px">
													<?php if (isset($_GET['id'])) {  ?>
														<?php
														$cid = $_GET['id'];
														$result3 = $obj->get_message($cid);
														while ($row_des2 = $result3->fetch_array()) {
															$type = $row_des2['from'];
															if ($type == 'admin') {
														?>
																<div class="chat-message-right pb-4">
																	<div>
																		<img src="<?php echo $web_assets_base_url; ?>images/logo.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
																		<div class="text-muted small text-nowrap mt-2"><?php echo $row_des2['date']; ?> <br><?php echo $row_des2['time']; ?></div>
																	</div>
																	<div class="flex-shrink-1 bg-light rightChat rounded py-2 px-3 mr-3" style="height:fit-content !important">
																		<div class="font-weight-bold mb-1"> </div>
																		<?php echo $row_des2['message']; ?>
																	</div>
																</div>
															<?php } else { ?>
																<div class="chat-message-left pb-4">
																	<div>
																		<img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
																		<div class="text-muted small text-nowrap mt-2"><?php echo $row_des2['date']; ?> <br><?php echo $row_des2['time']; ?></div>
																	</div>
																	<div class="flex-shrink-1 bg-light leftChat rounded py-2 px-3 ml-3">
																		<div class="font-weight-bold mb-1"><?php echo $row_des2['subject']; ?></div>
																		<?php echo $row_des2['message']; ?>
																	</div>
																</div>

														<?php }
														} ?>

													<?php } ?>
												</div>
											</div>

											<div class="flex-grow-0 py-3 px-4 border-top" style="background-color:#CDCCCB;">
												<?php if (isset($_GET['id'])) {  ?>
													<div class="input-group">
														<form action="../controllers/Support.php?status=add&id=<?php echo $_GET['id']; ?>" method="post" style="width: 100%">
															<div class="row">
																<div class="col">
																	<input type="hidden" name="cusid" value="<?php echo $_GET['id']; ?>">
																	<input type="text" name="message" class="form-control mb-2" placeholder="Type your message">
																</div>
																<div class="col-auto">
																	<button class="btn btn-primary">Send</button>
																</div>
															</div>
														</form>


													</div>
												<?php } ?>
											</div>

										</div>
									</div>
								</div>
							</div>
						</main>

						<!-- checking -->
						<div class="clearfix"></div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /page content -->

<?php include('footer.php') ?>