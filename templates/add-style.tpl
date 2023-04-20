<style>

{* TEMPLATES FOLDER: *}

.body-edit{
    height:100vh !important;
    font-size:16px;
}

/* Main wrapper: */
.wrapper-edit{ padding:0px; }

/* Sub wrapper: */
.page-wrapper-edit{
    background-image: url(./i/m-assets/white-bg/light_noise_diagonal.png) !important;
    display: flex;
    flex-direction: column;
    flex-wrap: nowrap;
    overflow: hidden;
}

/* Sub wrapper 2: */
.white-bg-edit{ 
    background-image: url(./i/m-assets/white-bg/light_noise_diagonal.png) !important;
    /* height: 100%; check */
    padding: 30px 30px 30px;
    flex:1;
}

/* Footer */
.footer-edit{
    background: #0089fe1a;
    /* background-image: linear-gradient(to bottom right, #a6d0ed, #cceeff); Old 1 */
    /* background-image: linear-gradient(to bottom right, silver, #cceeff); Old 2 */
    /* background-image: linear-gradient(to bottom right, #c0c0c036, #00aaff42); Old 3 */
    /* box-shadow: 2px 2px 5px 2px #888888; example */
    border-top: 1px solid #aaaaaa;
    /* border-top: 1px solid #e7eaec; Old */
}
.pull-left-edit{ margin-left:10px; }
.pull-right-edit{ margin-right:20px; }
.pull-right .btn{
    box-shadow: 2px 2px 2px 1px #888888;
}

.additional-class{
    position: fixed;
    height: 100vh;
    overflow-y: auto; 
}

/* Header Main: */
.border-bottom-edit{ padding: 12px 12px 7px 12px; }

.header-edit{ padding: 5px 14px 5px 14px; }

.nav-header-edit{
    background-image: linear-gradient(#ffdc7eab, #fab80654);
    /* background-image: linear-gradient(#c9a859, #786d4f); Old 1 */
    /* background-color: #dbd6ca; Old 2 */
    margin: 0 5px 5px 5px;
    padding: 5px;
    box-sizing: border-box;
    /* border: 2px solid #4c81ad; */
    /* box-shadow: 5px 5px 8px #888888; */
    border-radius: 10px;
    z-index:1;
}
.nav-header-edit #a-setout{
    text-decoration: underline;
    color: rgb(54 54 54);
    padding: 5px 0 5px 2px;
    display: block;
}
.nav-header-edit #a-setout:hover{
    color: rgb(233 183 136);
    /* color: rgb(184, 126, 71); old */
    background: none;
}

.navbar-header .btn-primary-edit{
    background-color: #3c72bc;
    border-color: #3c72bc;
    margin-left:15px;
    box-shadow: 2px 2px 5px #424181;
}
.navbar-header .btn-primary-edit:hover{
    background-color: #36619f !important;
    border-color: #3c72bc !important;
}

.cut-name{
    color:rgb(30 104 166);
    font-family: 'Times New Roman', Times, serif;
    text-shadow: 1px 1px #3e3e42;
    /* font-style: italic; */
}
.mini-navbar .nav-header-edit .cut-name{
    overflow:hidden; 
    white-space:nowrap; 
    text-overflow:ellipsis; 
    width:60px; 
}

.mini-navbar .nav-header-edit .cut-name-2{
    overflow:hidden; 
    white-space:nowrap; 
    text-overflow:ellipsis; 
    width:50px; 
}

.nav-header-top-edit{
    background-image: linear-gradient(#ff00002b, #04040461) !important;
    /* background-image: linear-gradient(#8b4444, #212628) !important; Old 1 */
    /* background-image: linear-gradient(#eb12123d, #212628) !important; Old 2 */
    margin: 5px 5px 10px 5px;
    border-radius: 10px;
    /* box-shadow: 5px 5px 16px #232328 inset; */
}

.navbar-static-side{ box-shadow: 5px 5px 8px #888888; }

.small-box, .small-box-footer{
    border-radius: 10px;
    box-shadow: 5px 5px 8px #616060;
}


.nav-header-edit #set-as{ color: #3e3e3e;}
.nav-header-edit #set-as, #set-as-2{
    font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
    /* font-family:Georgia, 'Times New Roman', Times, serif; Old */
}


/* pageListHeader.tpl -------------------------------------------------------- */

.form-group.group-edit{
    display: inline-block;
    width:70%;
}
@media screen and (max-width:1000px){
    .form-group.group-edit{
        width:90%;
    }
    
}

.itemsheader-edit{
    background: #0eb9f221;
    /* background: #def6fe; Old 1 */
    /* background-image: linear-gradient(#C5D5DC,#CBEAFA); Old 2 */
    box-shadow: 0px 0px 6px 3px #88888894;
    padding-top: 10px;
    border-radius: 6px;
}

.col-md-2-infoShow{
    font-weight: 900;
}

.btn-xs-edit{
    margin-left: 20px;
    margin-bottom: 10px;
    box-shadow: 2px 2px 4px 1px #436477;
}
/* ------------------------------------------------------------------------------- */

/* NAVBAR: */

/* Navbar Side */
.navbar-default-edit{
    background-image: url(./i/m-assets/sidebar/dark-honeycomb.png);
    /* background-image: linear-gradient(#050505, #42536B); old 1 */
    /* background-image: linear-gradient(#050505, #282222); old 2 */
    /* background-image: linear-gradient(#333a42, #3e576e); old 3 */
}

/* navbar top fixed */
.navbar-static-top-edit{
    background-image: linear-gradient(to bottom right,#00aaff3d, #c0c0c036);
    /* background-image: linear-gradient(to bottom right, silver, #cceeff); Old 2 */
    box-shadow: 0px 0px 6px 3px #88888894;
    border-radius: 6px;
}

.nav-label-edit{
    font-size: 18px;
    /* font-style: italic; Off */
    /*text-shadow: 2px 2px 1px #101010;*/
    /* text-shadow: 2px 2px 1px #494949; Old */
	font-family: 'Font Awesome';
	font-weight: 400;
}

.nav-label-edit-2{
    font-size: 17px !important;
    /*font-style: italic;*/
    /*text-shadow: 2px 2px 1px #101010;*/
	font-family: 'Font Awesome';
	font-weight: 400;
}

#side-menu .edit-fa{
    text-shadow: 3px 3px 2px #494949;
}

.nav.nav-second-level > li.active a{
    background: #6e6e6e28;
    /* background: #634242; old */
    /* background: #624e4e; old 2 */
    /* border-bottom: 1px solid white; */
    /* background-image: linear-gradient(#705d5d, #1c1919) !important; Old */
    /* background-image: linear-gradient(#794e4e, #1c1919) !important; Older */
}


/* ------------------------------------------------------------------------------- */
/* Button */
.button-3 {
  appearance: none;
  background-color: #37b1d2;
  /* background-color: #2e8ba4; old */
  /* background: linear-gradient(177deg, #2ea44f 0%, #58ce79 100%); */
  border: 1px solid rgba(27, 31, 35, .15);
  border-radius: 6px;
  /* box-shadow: rgba(27, 31, 35, .1) 0 1px 0; Old */ 
  box-shadow: 2px 2px 5px #424181;
  box-sizing: border-box;
  color: #fff;
  cursor: pointer;
  display: inline-block;
  font-family: -apple-system,system-ui,"Segoe UI",Helvetica,Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji";
  font-size: 14px;
  font-weight: 600;
  /* line-height: 20px; */
  padding: 6px 16px;
  margin-top: -5px;
  margin-right:5px;
  position: relative;
  text-align: center;
  text-decoration: none;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  vertical-align: middle;
  white-space: nowrap;
}

.button-3:hover {
  background-color: #6cc9e3;
  /* background-color: #45afcc; old */
  
}

/* ------------------------------------------ */
/* Dialog */
.ui-dialog{
    height: 80% !important;
    overflow-y: auto;
    box-shadow: 0px 0px 5px 2px #4d4d52;
    /* box-shadow: 0px 0px 2px 2px #424181; old */
}

.textarea{
    width:70%;
    height:200px;
    resize: none;
}


.textarea-dialog{
    width: 100% !important;
    height:20% !important;
	resize: none;
    box-sizing: border-box !important;
    background: #fdfdf4;
    margin-top: 65px;
}

.dialog_help_style .ui-dialog-titlebar {
    background: #c8f9ce;
    box-shadow: 2px 2px 5px #424181;
}

.dialog_message_style .ui-dialog-titlebar {
    background: #dfd0b5;
    box-shadow: 2px 2px 5px #424181;
}

.ui-dialog-buttonpane {
    position: absolute;
    top: 41px;
    width: 97%;
    border-width: 0 0 1px 0 !important;
}

.ui-dialog-buttonpane #saved-message{
    margin-right: 100px;
    border: 2px solid #ffe423;
    border-radius: 5px;
}

/* ------------------------------------------ */
/* EditForm: */
.box-info, .box-primary{
    background-image: url(./i/m-assets/white-bg/stripes-light.webp) !important;
    box-shadow: 5px 5px 8px #616060;
}

.box-body .row{
	margin-bottom: 10px;
}

.box-body .row-edit-2{
	margin-top:5px;
}

.box-body-edit{ background: #3f67b9; }

.box-header-edit{
    background: #3f67b9;
    color: white;
}

{* END OF TEMPLATES: ======================================================================================  *}
{* ========================================================================================================  *}


{* PLUGINS FOLDER: ===============================================================  *}

/* DriversTransfers/templates/index.tpl and AgentsTransfers/templates/index.tpl */
.row_e:hover{ background:rgb(229, 229, 240); }
/* Off */ /* .row_e{ padding:0 0 3px 0; font-size:18px; } */
.col-md-4_e{ margin-bottom: 5px; }


/* Booking/templates */
.book{ color:white; }
.book label{ color:white; }
#selectTo_options a{ color:white; }
#selectFrom_options a { color:white; }
.row-add{ padding:20px; }
.listTile .fa-user{ color:#797373; }

/* Route */
#TerminalID{
	height:20px;
	z-index:1;
	width:405px;
}
#TerminalID option:hover{
    background: #0088cc;
    color: white;
}

/* ====================================================================================== */
/* ListTemplate.php */
#show_items .row-edit{
    color:#179ae6;
    /* color:#3C8DBC; older */
    font-weight:bold;
    padding:10px 0;
    /*text-shadow: 2px 2px 8px #ada3cc; spare */
}

#show_items{
    border: 1px solid #00000026;
    border-radius: 5px;
    padding: 15px;
    background: #c0c0c026;
    box-shadow: 0px 0px 5px 1px #898989;
}

.row-edit div{
    border-right:1px solid rgb(105, 131, 170);
}
.row-edit div:last-child{
    border-right:none;
}

.pad1em{
    padding: 2px 0;
    cursor:pointer; 
    border-top:1px solid rgb(179, 179, 179) !important;
    font-family: Lucida sans-serif;
    font-size: 17px;
}
.pad1em div{
    border-right:1px solid rgb(187, 187, 187);
}
.pad1em div:last-child{
    border-right:none;
}
.pad1em:hover{ background: rgb(0 0 0 / 9%) !important; }

/* off */
/* .listTitleEdit{ cursor:auto !important; } */
/* .listTile:focus{ background: rgb(71, 42, 173); } */


/* ====================================================================================== */

/* Bookings/Orders */
.row-sticky{
    position: sticky;
    top: 0;
    z-index: 5;
    background-color: white;
    margin-left: 0px;
    margin-right: 0px;
    color: #0088cc;
    /* background: #a1bdca; */
}

.row .itemsheader-edit{
    background: #00bdfb12;
    /* background: #dadbebc0; Old */
    border: 1px solid #c5c5c5;
    position: sticky;
    top: 20;
    z-index: 5;
    margin-left: 0px;
    margin-right: 0px;
    padding: 5px;
    box-shadow: 5px 5px 8px #616060;
}
.row .itemsheader-edit .col-md-2{
    border-right: 1px solid #c5c5c5;
}

.row .listTile-edit{
    display: flex;
    margin-left: 0px;
    margin-right: 0px;
    background:#d9d8d8;
}
.listTile-edit .col-md-2{
    background: #86bbd6;
    margin: 5px;
    border-radius: 5px;
    box-sizing: border-box;
    box-shadow: 5px 5px 8px #616060;
}
.listTile-edit .col-md-2:hover{
    background: #9fc7db;
}

.select-top-edit{
    color:rgb(78 66 66);
    padding:2px;
    border-radius: 5px !important;
    margin-bottom: 2px;
    box-shadow: 2px 2px 4px #616060 inset;
}
.select-bottom-edit{
    color:rgb(78 66 66);
    padding:2px;
    border-radius: 5px !important;
    margin-top: 2px;
    box-shadow: 2px 2px 4px #616060 inset;
}

.button-asc-edit, .button-desc-edit{
    box-shadow: 2px 2px 4px #616060;
    background: #7ec2e9;
    border: 1px solid rgb(152, 152, 155);
}

.input-one{ border-radius: 5px !important; }

.select-top-edit, .select-bottom-edit, .button-asc-edit, .button-desc-edit, .input-one{
    outline:none;
    border:2px solid rgb(192, 199, 241);
    font-family: 'Times New Roman', Times, serif;
    color:rgb(59, 59, 66) !important;
}
.select-top-edit:focus, .select-bottom-edit:focus, .button-asc-edit:focus, .button-desc-edit:focus, .input-one:focus{
    outline:none;
    border:2px solid rgb(135, 147, 218);
}

.badge-edit{
    color: #054ff3;
    background: #f9f9f9;
}

.btn-default-edit{
    color:white !important;
}
.btn-default-edit:hover{
    color:black !important;
}
/* End of Bookings/Orders */
/* ====================================================================================== */

/* Exchange rate, Vat Rate */
.container .shadowLight-edit{
    background: transparent !important;
    margin: 0px;
    padding: 5px;
    border: none !important;
    box-shadow: none;
    cursor: auto;
}

/* Checkbox: */
.row-checkbox-edit input[type=checkbox]{
    display: block;
    cursor: pointer;
    /* appearance: none; */
    background-color: #fff;
    margin: 0;
    font: inherit;
    color: currentColor;
    width: 2.15em;
    height: 2.15em;
    border: 0.15em solid currentColor;
    border-radius: 0.15em;
    transform: translateY(-0.075em);
    box-shadow: 0px 0px 2px 1px #888888;
}

/* Buttons: */
.go-edit, .rate-edit{
    box-shadow: 2px 2px 5px 1px #42484d;
}

.btn.btn-primary:hover,
.btn.btn-primary:active,
.btn.btn-primary.hover {
  background: #66bbee;
  border-color: #367fa9;
}

#pageSelect .btn.btn-primary{
    box-shadow: 0px 0px 4px 1px #888888;
}

/* ====================================================================================== */

{* END OF PLUGINS FOLDER: ===============================================================  *}
{* ======================================================================================  *}

/* ============================================================================== */
/* SCROLL BAR: */
/* width */
::-webkit-scrollbar {
    width: 12px;
}

/* Track */
::-webkit-scrollbar-track {
    background: #f1f1f1;
    margin-right: 5px;
    
}
 
/* Handle */
::-webkit-scrollbar-thumb {
    background: #aaa;
    border: 2px solid #3e3231c9;
    /* border: 2px solid #bd6d61c9; Old */
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #646363;
    
}
/* ============================================================================== */






</style>