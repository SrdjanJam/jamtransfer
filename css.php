<style>
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

/* -------------------------------- */

</style>
