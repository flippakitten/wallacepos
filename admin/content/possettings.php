<!-- WallacePOS: Copyright (c) 2014 WallaceIT <micwallace@gmx.com> <https://www.gnu.org/licenses/lgpl.html> -->
<div class="page-header">
    <h1>
        POS Settings
        <small>
            <i class="icon-double-angle-right"></i>
            Manage global POS settings
        </small>
    </h1>
</div><!-- /.page-header -->
<div class="row">
    <div class="col-sm-6">
        <div class="widget-box transparent">
            <div class="widget-header widget-header-flat">
                <h4 class="lighter">Receipt</h4>
            </div>

            <div class="widget-body" style="padding-top: 10px;">
                <form class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-5"><label>Header Line 2:</label></div>
                        <div class="col-sm-5"><input type="text" id="recline2" /></div>
                    </div>
                    <div class="space-4"></div>
                    <div class="form-group">
                        <div class="col-sm-5"><label>Header Line 3:</label></div>
                        <div class="col-sm-5"><input type="text" id="recline3" /></div>
                    </div>
                    <div class="space-4"></div>
                    <div class="form-group">
                        <label class="col-sm-5">Receipt Printer Logo:</label>
                        <div class="col-sm-5">
                            <input type="text" id="reclogo" /><br/>
                            <img id="reclogoprev" width="128" height="64" src="" />
                            <input type="file" id="reclogofile" name="file" />
                            <small>Must be a monochromatic 1-bit png (256*128)</small>
                        </div>
                    </div>
                    <div class="space-4"></div>
                    <div class="form-group">
                        <label class="col-sm-5">Print Receipt Logo:</label>
                        <div class="col-sm-5">
                            <input type="checkbox" id="recprintlogo" value="true" />
                        </div>
                    </div>
                    <div class="space-4"></div>
                    <div class="form-group">
                        <label class="col-sm-5">Receipt Currency Character:</label>
                        <div class="col-sm-5">
                            <input type="text" id="reccurrency" /><br/>
                            <small>Supply an alternate decimal charcode or leave blank to disable</small>
                        </div>
                    </div>
                    <div class="space-4"></div>
                    <div class="form-group">
                        <label class="col-sm-5">Browser/Email Logo:</label>
                        <div class="col-sm-5">
                            <input type="text" id="recemaillogo" /><br/>
                            <img id="emaillogoprev" width="128" height="64" src="" />
                            <input type="file" id="emaillogofile" name="file" />
                        </div>
                    </div>
                    <div class="space-4"></div>
                    <div class="form-group">
                        <label class="col-sm-5">Receipt Footer Text:</label>
                        <div class="col-sm-5"><input type="text" id="recfooter" /></div>
                    </div>
                    <div class="space-4"></div>
                    <div class="form-group">
                        <label class="col-sm-5">Promo QR code:</label>
                        <div class="col-sm-5"><input type="text" id="recqrcode" /><br/><small>Leave blank to disable</small>
                            <img width="100" src="/docs/qrcode.png">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="widget-box transparent">
            <div class="widget-header widget-header-flat">
                <h4 class="lighter">POS Records: Load sale records...</h4>
            </div>

            <div class="widget-body" style="padding-top: 10px;">
                <form class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-5"><label>for the last:</label></div>
                        <div class="col-sm-5">
                            <select id="salerange">
                                <option value="week">1 week</option>
                                <option value="day">1 day</option>
                                <option value="month">1 month</option>
                            </select>
                        </div>
                    </div>
                    <div class="space-4"></div>
                    <div class="form-group">
                        <div class="col-sm-5"><label>Include:</label></div>
                        <div class="col-sm-5">
                            <select id="saledevice">
                                <option value="device">Devices sales</option>
                                <option value="location">Locations sales</option>
                                <option value="all">All sales</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="widget-box transparent">
            <div class="widget-header widget-header-flat">
                <h4 class="lighter">Sale Options</h4>
            </div>
            <div class="widget-body" style="padding-top: 10px;">
                <form class="form-horizontal">
                    <div>
                        <div class="form-group">
                            <div class="col-sm-5"><label>Allow Change of Stored Item Prices:</label></div>
                            <div class="col-sm-5">
                                <select id="priceedit">
                                    <option value="blank">When Price is Blank</option>
                                    <option value="always">Always</option>
                                </select>
                            </div>
                        </div>
                        <div class="space-4"></div>
                        <div class="form-group">
                            <div class="col-sm-5"><label>Cash rounding:</label></div>
                            <div class="col-sm-5">
                                <select id="cashrounding">
                                    <option value="0">None</option>
                                    <option value="5">5¢</option>
                                    <option value="10">10¢</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 align-center form-actions">
        <button class="btn btn-success" type="button" onclick="saveSettings();"><i class="icon-save align-top bigger-125"></i>Save</button>
    </div>
</div>
<script type="text/javascript">
        var options;

        function saveSettings(){
            // show loader
            WPOS.util.showLoader();
            var data = {};
            $("form :input").each(function(){
                data[$(this).prop('id')] = $(this).val();
            });
            // fix for checkbox
            data.recprintlogo = $("#recprintlogo").is(":checked")?true:false;
            WPOS.sendJsonData("settings/pos/set", JSON.stringify(data));
            // hide loader
            WPOS.util.hideLoader();
        }

        function loadSettings(){
            options = WPOS.getJsonData("settings/pos/get");
            // load option values into the form
            for (var i in options){
                $("#"+i).val(options[i]);
            }
            // unfortunately the above doesn't work for checkboxes :( so a fix is below :)
            if (options.recprintlogo==true){
                $("#recprintlogo").prop("checked", "checked");
            }
            // set logo images
            $("#reclogoprev").attr("src", options.reclogo);
            $("#emaillogoprev").attr("src", options.recemaillogo);
        }

        $('#reclogofile').on('change',uploadRecLogo);
        $('#reclogo').on('change',function(e){
            $("#reclogoprev").prop("src", $(e.target).val());
        });

        $('#emaillogofile').on('change',uploadEmailLogo);
        $('#recemaillogo').on('change',function(e){
            $("#emaillogoprev").prop("src", $(e.target).val());
        });

        function uploadRecLogo(event){
            WPOS.uploadFile(event, function(data){
                $("#reclogo").val(data.path);
                $("#reclogoprev").prop("src", data.path);
                saveSettings();
            }); // Start file upload, passing a callback to fire if it completes successfully
        }

        function uploadEmailLogo(event){
            WPOS.uploadFile(event, function(data){
                $("#recemaillogo").val(data.path);
                $("#emaillogoprev").prop("src", data.path);
                saveSettings();
            }); // Start file upload, passing a callback to fire if it completes successfully
        }

        $(function(){
            loadSettings();

            // hide loader
            WPOS.util.hideLoader();
        })
</script>