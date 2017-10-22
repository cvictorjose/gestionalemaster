
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="//cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
<script src="{{ url('adminlte/js') }}/bootstrap.min.js"></script>
<script src="{{ url('adminlte/js') }}/select2.full.min.js"></script>
<script src="{{ url('adminlte/js') }}/main.js"></script>

<script src="{{ url('adminlte/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/fastclick/fastclick.js') }}"></script>
<script src="{{ url('adminlte/js/app.min.js') }}"></script>
<script>
    window._token = '{{ csrf_token() }}';
</script>

<script>
    $('div.alert').delay(3000).slideUp(300);


    $(document).ready(function() {

        $('.js-data-example-ajax').select2({
            ajax: {
                url: '/typeahead-response',
                data: function (params) {
                    var query = {
                        query: params.term,
                        type: 'public'
                    }

                    // Query parameters will be ?search=[term]&type=public
                    return query;
                }
            }
        });

        $('#radioBtn a').on('click', function(){
            var sel = $(this).data('title');
            var tog = $(this).data('toggle');
            $('#'+tog).prop('value', sel);

            $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
            $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
        })




       /* $('.js-data-example-ajax').select2({

            ajax: {
                url: '/typeahead-response',
                processResults: function (data) {
                    // Tranforms the top-level key of the response object from 'items' to 'results'
                    return {

                        results: data.items
                    };
                }
            }

           /!* ajax: {
                url: '/typeahead-response',
                data: function (params) {
                    var query = {
                        query: params.term,
                        type: 'public'
                    }

                    // Query parameters will be ?search=[term]&type=public
                    return query;
                }
            }*!/
        });*/




    });



</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>--}}
{{--<script type="text/javascript">
    var url = "{{ route('typeahead.response') }}";
    $('#search_text').typeahead({


        /*source: function (query, process) {
            var $this = this //get a reference to the typeahead object
            return $.get(url, { query: query }, function (data) {
                var options = [];
                $this["map"] = {}; //replace any existing map attr with an empty object
                $.each(data,function (i,val){
                    options.push(val.lab_name);
                    $this.map[val.lab_name] = val.id; //keep reference from name -> id
                });
                return process(options);
            });
        },
        updater: function (item) {
            console.log(this.map[item],item); //access it here
            $('.search_text').val(this.map[item],item);
        }*/


        source: function (query, process) {
            states = [];
            map = {};

            return $.get(url, { query: query }, function (data) {

            $.each(data, function (i, state) {
                map[state.lab_name] = state;
                states.push(state.lab_name);
            });
            console.log(data);
            process(states);

            });
        },

        matcher: function (item) {
            if (item.toLowerCase().indexOf(this.query.trim().toLowerCase()) != -1) {
                return true;
            }
        },

        updater: function (item) {
            $('#invisible_id').attr('value', map[item].id);
            return item;
        }

        /*source:  function (query, process) {
            return $.get(url, { query: query }, function (data) {
                return process(data);
            });
        }*/
    });
</script>--}}




@yield('javascript')