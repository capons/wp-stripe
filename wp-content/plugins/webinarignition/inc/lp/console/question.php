<!-- ON AIR AREA -->
	<div id="questionTab" style="display:none;" class="consoleTabs" >

		<div class="statsDashbord">

			<div class="statsTitle">
				
				<div class="statsTitleIcon">
					<i class="icon-question-sign icon-2x"></i>
				</div>
				
				<div class="statsTitleCopy">
					<h2>Manage Live Questions</h2>
					<p>All of your questions - answered & unanswered...</p>
				</div>
				
				<br clear="all" />

			</div>

		</div>

	<div class="innerOuterContainer">	
	<div class="innerContainer">

		<div class="statsQuestionsTab" style="margin-top: -70px;" >

			<div class="questionTabIt questionTabSelected" id="qa-active">
				<i class="icon-question"></i> Active Questions <span class="labelQA" id="totalQAActive" style='display: none;' ><?php echo $totalQuestionsActive; ?></span>
			</div>

			<div class="questionTabIt" id="qa-done" >
				<i class="icon-check-sign"></i> Answered Questions <span class="labelQA" id="totalQADone" style='display: none;'><?php echo $totalQuestionsDone; ?></span>
			</div>

			<!-- <div class="questionTabIt">
				<i class="icon-file-text"></i> Export CSV
			</div> -->

			<br clear="left" />

		</div>

		<br clear="all" />

		<div class="questionMainTabe" id="QAActive">

			<div class="airSwitch" style="padding-top: 0px;" >
			
				<div class="airSwitchLeft">
					<span class="airSwitchTitle" >Active / Unanswered Questions</span>
					<span class="airSwitchInfo">Below are the questions that have come in that are yet to be answered...</span>
				</div>

				<div class="airSwitchRight">
					<a href="#" class="small disabled button secondary" style="margin-right: 0px;" ><i class="icon-refresh"></i> Questions Will Auto-Update</a>
					<a target="_blank" href="<?php echo $sitePath; ?>inc/csv2q.php?id=<?php echo $client; ?>" class="small button secondary" style="margin-right: 0px;" ><i class="icon-file-text"></i> CSV</a>
				</div>
				
				<br clear="all" />

			</div>

			<input type="text" class="searchQAActive" placeholder="Search Through Your Active Questions...">

			<div id="question1" class="questionsBlock" >

				
				<?php
                foreach($questionsActive as $questionsActive) {
                ?>

				<!-- QUESTION BLOCK -->
				<div class="questionBlockWrapper questionBlockWrapperActive" qa_lead="<?php echo $questionsActive->ID; ?>" id="QA-BLOCK-<?php echo $questionsActive->ID; ?>" >

					<div class="questionBlockQuestion">
						<span class="questionBlockTitle" ><?php echo $questionsActive->question; ?></span>
						<span class="questionBlockAuthor" ><?php echo $questionsActive->name; ?> - <span class="radius secondary label qa-lead-search"><?php echo $questionsActive->email; ?></span></span>
					</div>

					<div class="questionActions">

						<div class="questionBlockIcons qbi-remove" qaID="<?php echo $questionsActive->ID; ?>">
							<i class="icon-remove icon-large"></i>
						</div>

						<div class="questionBlockIcons qbi-reply" mail="<?php echo $questionsActive->email; ?>" >
							<i class="icon-comments icon-large"></i>
						</div>

						<div class="questionBlockIcons qbi-answer" id="qbi-answer-<?php echo $questionsActive->ID; ?>" qaID="<?php echo $questionsActive->ID; ?>">
							<i class="icon-check-sign icon-large"></i>
						</div>

						<br clear="left" />

					</div>

					<br clear="all" />

				</div>
				<!-- END OF QUESTION BLOCK -->

				<?php
				}
				?>

				<?php
                foreach($questionsActiveOLD as $questionsActive) {
                ?>

				<!-- QUESTION BLOCK -->
				<div class="questionBlockWrapper questionBlockWrapperActive" qa_lead="<?php echo $questionsActive->ID; ?>" id="QA-BLOCK-<?php echo $questionsActive->ID; ?>" >

					<div class="questionBlockQuestion">
						<span class="questionBlockTitle" ><?php echo $questionsActive->question; ?></span>
						<span class="questionBlockAuthor" >N/A Info</span>
					</div>

					<div class="questionActions">

						<div class="questionBlockIcons qbi-remove2" qaID="<?php echo $questionsActive->ID; ?>">
							<i class="icon-remove icon-large"></i>
						</div>

						<!-- <div class="questionBlockIcons qbi-reply" >
							<i class="icon-comments icon-large"></i>
						</div> -->

						<div class="questionBlockIcons qbi-answer2" id="qbi-answer-<?php echo $questionsActive->ID; ?>" qaID="<?php echo $questionsActive->ID; ?>">
							<i class="icon-check-sign icon-large"></i>
						</div>

						<br clear="left" />

					</div>

					<br clear="all" />

				</div>
				<!-- END OF QUESTION BLOCK -->

				<?php
				}
				?>


			</div>

		</div>

		<div class="questionMainTabe" id="QADone" style="display:none;" >

			<div class="airSwitch" style="padding-top: 0px;" >
			
				<div class="airSwitchLeft">
					<span class="airSwitchTitle" >Answered Questions</span>
					<span class="airSwitchInfo">Below are all the answered questions...</span>
				</div>

				<div class="airSwitchRight">
					<!-- <a href="#" class="small button secondary" style="margin-right: 0px;" ><i class="icon-file-text"></i> Export All To CSV</a> -->
				</div>
				
				<br clear="all" />

			</div>

			<input type="text" class="searchQADone" placeholder="Search Through Your Active Questions...">

			<div id="question2" class="questionsBlock" >
				
				<?php
                foreach($questionsDone as $questionsDone) {
                ?>

				<!-- QUESTION BLOCK -->
				<div class="questionBlockWrapper questionBlockWrapperDone" qa_lead="<?php echo $questionsDone->ID; ?>" id="QA-BLOCK-<?php echo $questionsDone->ID; ?>" >

					<div class="questionBlockQuestion">
						<span class="questionBlockTitle" ><?php echo $questionsDone->question; ?></span>
						<span class="questionBlockAuthor" ><?php echo $questionsDone->name; ?> - <span class="radius secondary label qa-lead-search"><?php echo $questionsDone->email; ?></span></span>
					</div>

					<div class="questionActions">

						<div class="questionBlockIcons qbi-removeDone" qaID="<?php echo $questionsDone->ID; ?>">
							<i class="icon-remove icon-large"></i>
						</div>

						<div class="questionBlockIcons qbi-reply" mail="<?php echo $questionsDone->email; ?>" >
							<i class="icon-comments icon-large"></i>
						</div>

						<!-- <div class="questionBlockIcons qbi-answer" qaID="<?php echo $questionsDone->ID; ?>">
							<i class="icon-check-sign icon-large"></i>
						</div> -->

						<br clear="left" />

					</div>

					<br clear="all" />

				</div>
				<!-- END OF QUESTION BLOCK -->

				<?php
				}
				?>

				<?php
                foreach($questionsDoneOLD as $questionsDone) {
                ?>

				<!-- QUESTION BLOCK -->
				<div class="questionBlockWrapper questionBlockWrapperDone" qa_lead="<?php echo $questionsDone->ID; ?>" id="QA-BLOCK-<?php echo $questionsDone->ID; ?>" >

					<div class="questionBlockQuestion">
						<span class="questionBlockTitle" ><?php echo $questionsDone->question; ?></span>
						<span class="questionBlockAuthor" >N/A Info</span>
					</div>

					<div class="questionActions">

						<div class="questionBlockIcons qbi-remove2" qaID="<?php echo $questionsDone->ID; ?>">
							<i class="icon-remove icon-large"></i>
						</div>

						<!-- <div class="questionBlockIcons qbi-reply" >
							<i class="icon-comments icon-large"></i>
						</div> -->

						<!-- <div class="questionBlockIcons qbi-answer" qaID="<?php echo $questionsDone->ID; ?>">
							<i class="icon-check-sign icon-large"></i>
						</div> -->

						<br clear="left" />

					</div>

					<br clear="all" />

				</div>
				<!-- END OF QUESTION BLOCK -->

				<?php
				}
				?>

			</div>

		</div>
		

	</div>
	</div>

	</div>