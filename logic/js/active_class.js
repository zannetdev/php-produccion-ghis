class ClassManager {
    static ActiveSimpleItem(id){
        $("#"+id).addClass("active");
    }
    static ActiveMenuItem(id_menu, id_item){
        $("#"+id_menu).addClass("active");
        $("#"+id_item).addClass("active");
    }
}