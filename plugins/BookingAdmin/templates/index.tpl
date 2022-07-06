<div
  style="
    background: transparent url('./i/header/112.jpg') center fixed;
    background-size: cover;
    margin-top: -20px !important;
  "
>
  <br />
  <div
    class="container pad1em"
    style="
      background-color: rgba(70, 79, 96, 0.75);
      border: 1px solid #000;
      border-radius: 6px;
    "
  >
    <div class="row">
      <div class="col s12 xucase center white-text">
        <h3>ADMINISTRATION {$BOOKING}</h3>
        <p class="divider clearfix"></p>
      </div>
      <div class="col s12 xgrey xlighten-3">
        <br />
        <form
          action=""
          id="bookingForm"
          name="bookingForm"
          method="POST"
          enctype="multipart/form-data"
          onsubmit="return validateBookingForm();"
        >
          <input type="hidden" id="pleaseSelect" value="{$PLEASE_SELECT}" />
          <input type="hidden" id="loading" value="{$LOADING}" />
          <div class="col l6 s12">
            <label for="AuthUserIDe"
              ><i class="fa fa-globe"></i>Book as <strong>Agent</strong></label
            ><br />
            <div>
              <select
                name="AgentID"
                id="AgentID"
                class="xchosen-select browser-default"
                value="{$AgentID}"
              >
                <option value="0">---</option>
                {section name=index loop=$agents}
                <option value="{$agents[index].AuthUserID}">
                  {$agents[index].AuthUserCompany}
                </option>
                {/section}
              </select>
            </div>
          </div>
          <div class="col s12 l2">
            <label for="ReferenceNo"
              ><i class="fa fa-book"></i>Agent Reference Number</label
            ><br />
            <input type="text" id="ReferenceNo" value="" />
          </div>
          <div class="col s12 l2" id="webyblock" style="display: none">
            <label for="wrn"
              ><i class="fa fa-book">Weby Reference Number</i></label
            >
            <input
              type="text"
              id="weby_key"
              name="weby_key"
              value="{$weby_key}"
              disabled
            /><br />
            <select
              name="wref"
              id="wref"
              class="browser-default"
              value=""
            ></select>
          </div>

          <div class="col s12 l2" id="sunblock" style="display: none;">
          <label for="srb"><i class="fa fa-book"></i>Sun Reference Number1</label><br>
            <input type="file" id="srn" class="browser-default" name="SunReferenceNo" value="">
        </div>
        <div class="col s12 l6"></div>
<div></div>


        </form>
      </div>
    </div>
  </div>
</div>
