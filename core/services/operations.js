class Operations{
    static SumApc(monto){
        $.ajax({
            type: "POST",
            url: URL + 'service/sum_apc',
            data: {
                monto: monto
            },
            success:(res)=>{
                console.log(res)
            }
        });
    }
}