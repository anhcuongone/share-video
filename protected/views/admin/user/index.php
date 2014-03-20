<script type="text/javascript">
            $(document).ready(function () {
                var url = "<?php echo Yii::app()->request->baseUrl; ?>/admin/user/GetAll";
                var source =
                {
                    dataType: "json",
                    datafields: [
                        { name: 'id' },
                        { name: 'username' }
                    ],
                    url: url,
                    async: false
                };
               
                var dataAdapter = new $.jqx.dataAdapter(source);
                
                // Create a jqxComboBox
                $("#jqxcombobox").jqxComboBox({ selectedIndex: 0, source: dataAdapter, displayMember: "username",valueMember:"id", width: 200, height: 25});
                // trigger the select event.
                // disable the sixth item.
               // $("#jqxcombobox").jqxComboBox('disableAt', 5);
                // bind to 'select' event.
                $('#jqxcombobox').bind('select', function (event) {
                    var args = event.args;
                    var item = $('#jqxcombobox').jqxComboBox('getItems');
                    alert('Selected: ' +item[0].value);
                });
            });
        </script>
        <div id='jqxcombobox'>
        </div>