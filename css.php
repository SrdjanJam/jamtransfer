<style>

	/* CALENDAR: */

	* {
		box-sizing: border-box;
	}
	body {
		font-family: Arial, Helvetica, sans-serif;
	}
	.grid-container {
		display: grid;
		grid-gap: 1px;
		grid-template-columns: auto auto auto auto auto auto auto;
		padding: 1px;
		margin: 10px auto;
		background-color: rgba(235, 235, 235, 0.8);
	}
	.grid-item {
		background-color: rgba(235, 235, 235, 0.8);
		padding: 5px;
		font-size: 15px;
		text-align: center;
	}
	.grid-item-2 {
		background:white;
		padding: 2px;
	}
	.show-data .small{
		font-size:16px;
	}

	/* Media section: */

	@media screen and (max-width:767px) {
		.wrapper{
			padding:0px;
		}
		.body{
			padding:0;
		}
		.fullscreen{
			z-index: 9999; 
			width: 100%; 
			height: 100%; 
			position: fixed; 
			top: 0; 
			left: 0; 
			background:#f3f1f1;

			/* Animation */
			animation: myAnim 0.5s ease 0s 1 normal forwards;
		}

		/* keyframes  */
		@keyframes myAnim {
			0% {
				transform: scale(0.5);
			}

			100% {
				transform: scale(1);
			}
		}


		a.close-gi{
			color:rgb(185, 65, 65);
			font-size:35px;
			border:1px solid red;
			padding:5px;
		}
		.grid-item-2{
			overflow-y: auto;
		}
		.days .small{
			color:black;
			font-size:30px;
		}
		.days b{
			font-size:30px;
		}
		.days .small-mini{
			font-size:17px;
		}
		
	}

/* ================================================================= */

	/*MESSAGES:*/

	@media only screen and (max-width: 1350px) {
		/* For mobile phones: */
		/* Check: */
		/* [class*="col-"] :not(.col-md-2-edit){
			width: 100% !important;
		} */
	}


	/* ORDERS: */

	.right-edit{
		border-bottom: 1px solid #1b8aab;
		font-size: 22px;
		background: #c8dff3;
		padding: 1px 5px;
		border-radius: 5px;
		box-shadow: 2px 1px 3px 0px #6ba4e3;
		/* box-shadow: 2px 1px 3px 0px #4a4848; old */
		text-shadow: #4ba7e1 1px 0 2px;
	}

	.right-edit a{
		color: #1186e0;
		/* Old:
		color: #0c81e5;
		background: #dbdbdb; 
		*/
	}

	.right-edit a:hover{
		color: #009efb;
	}

	.inner-edit{
		border-style: none !important;
	}

	.icon h4{
		color: cornflowerblue;
	}

	.grey{
		background-color: #6cd7f3 !important;
	}

	/* Sum edit for report: */
	.sum-edit{
		display: flex;
	}
	.sum-edit div{
		padding: 5px;
		flex-basis: 100%;
		/* text-align: center; */
	}

	.sum-edit-labels{
		padding: 5px;
	}
	.sum-edit-labels p{
		margin-bottom: 0;
		color: #626161;
    	font-weight: bold;
		direction: rtl;
	}

	.sum-edit-labels p, .sum-edit-2 div{
		direction: rtl; /* from right to left position*/
	}

	.sum-edit-2{
		padding: 5px;
	}

	.sum-edit-2:nth-of-type(2n){
		background: #ebf0f5;
	}

	.no-style{
		all: unset; /* No style for this element */
	}

	.add-direction{
		direction: ltr !important;
	}

	/* EditForm  */
	.selectable-edit{
		margin-left:0 !important;
		margin-right:0 !important;
	}
	.blue-123{
		color: blue;
	}	
	.green-123{
		color: green;
	}	
	.red-123{
		color: red;
	}

	#newDriverName select{
		width:90%;
	}

/* ======================================================================== */

	/*SPECIAL DATES:*/

	.w-edit{
		width:180px;
	}

/* ======================================================================== */

	/*TASKS:*/

	/*EditForm:*/
	.large {
		width: 700px;
		height: auto;

		background-color: #fc0;
		margin: 10px auto;
	}
	.rotate {
	  -moz-transform: rotate(90deg);
	  -webkit-transform: rotate(90deg);
	  -o-transform: rotate(90deg);
	  -ms-transform: rotate(90deg);
	  transform: rotate(90deg);
	}

/* ======================================================================== */

	/*EXPENSES:*/

	/*ListTemplate:*/
	.rotate {
	  -moz-transform: rotate(90deg);
	  -webkit-transform: rotate(90deg);
	  -o-transform: rotate(90deg);
	  -ms-transform: rotate(90deg);
	  transform: rotate(90deg);
	}

	/* Envelop: */
	.fa-envelope-edit{
		font-size: 25px !important;
		color: #47afe9;
	}

	.envelop-note{
		padding: 5px;
		background: #b3ccff;
		box-shadow: 2px 1px 6px 2px #888888;
	}

	.right-edit{
		border-bottom: 1px solid #1b8aab;
		font-size: 22px;
		background: #c8dff3;
		padding: 1px 5px;
		border-radius: 5px;
		box-shadow: 2px 1px 3px 0px #6ba4e3;
		/* box-shadow: 2px 1px 3px 0px #4a4848; old */
		text-shadow: #4ba7e1 1px 0 2px;
	}

	.right-edit a{
		color: #1186e0;
		/* Old:
		color: #0c81e5;
		background: #dbdbdb; 
		*/
	}

	.right-edit a:hover{
		color: #009efb;
	}

	.inner-edit{
		border-style: none !important;
	}

	.icon h4{
		color: cornflowerblue;
	}

	.grey{
		background-color: #6cd7f3 !important;
	}

	.green-text{
		color: green !important;
	}

	.red-text{
		color: red !important;
	}

	/* Sum edit for report: */
	.sum-edit{
		display: flex;
	}
	.sum-edit div{
		padding: 5px;
		flex-basis: 100%;
		/* text-align: center; */
	}

	.sum-edit-labels{
		padding: 5px;
	}
	.sum-edit-labels p{
		margin-bottom: 0;
		color: #626161;
		font-weight: bold;
		direction: rtl;
	}

	.sum-edit-labels p, .sum-edit-2 div{
		direction: rtl; /* from right to left position */
	}

	.sum-edit-2{
		padding: 5px;
	}

	.sum-edit-2:nth-of-type(2n){
		background: #ebf0f5;
	}

	.no-style{
		all: unset; /* No style for this element */
	}

	.add-direction{
		direction: ltr !important;
	}

	/*EditForm:*/
	.large {
		width: 700px;
		height: auto;

		background-color: #fc0;
		margin: 10px auto;
	}
	.rotate {
	  -moz-transform: rotate(90deg);
	  -webkit-transform: rotate(90deg);
	  -o-transform: rotate(90deg);
	  -ms-transform: rotate(90deg);
	  transform: rotate(90deg);
	}

</style>
