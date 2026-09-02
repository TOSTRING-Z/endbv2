/**
 * Created by yangmqglobe on 2017/5/13.
 */
$(function () {

    /**
     * 监听下拉框的展开和收起状态，改变提示符
     */
    $('#cell_type_collapse').on('hidden.bs.collapse', function () {
        $('#cell_type_collapse_btn').html("<span class=\"glyphicon glyphicon-chevron-down\"></span>");
    });
    $('#cell_type_collapse').on('shown.bs.collapse', function () {
        $('#cell_type_collapse_btn').html("<span class=\"glyphicon glyphicon-chevron-up\"></span>");
    });
    $('#tissue_collapse').on('hidden.bs.collapse', function () {
        $('#tissue_collapse_btn').html("<span class=\"glyphicon glyphicon-chevron-down\"></span>");
    });
    $('#tissue_collapse').on('shown.bs.collapse', function () {
        $('#tissue_collapse_btn').html("<span class=\"glyphicon glyphicon-chevron-up\"></span>");
    });

    /**
     * 实例化表格
     */
    $('#data_table').dataTable({
        responsive: true,
        processing: true,
        pagingType: "numbers",
        iDisplayLength: 25,
        language: {
            searchPlaceholder: "eg. H1"
        }
    });
});
