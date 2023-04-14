function abrirModalNuevoCich(){
    $("#modal_nuevo_cich").modal({backdrop:'static',keyboard:false})
    $("#modal_nuevo_cich").modal('show');
}


var table;
function listar_usuario_cich(){
    table = $("#tabla_cich").DataTable({
       "ordering":false,
       "paging": false,
       "searching": { "regex": true },
       "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
       "pageLength": 100,
       "destroy":true,
       "async": false ,
       "processing": true,
       "ajax":{
           "url":"../controlador/colegios/controlador_cich.php",
           type:'POST'
       },
       "columns":[
           {"data":"Expediente"},
           {"data":"Tipo_de_Proyecto"},
           {"data":"Propietario"},
           {"data":"Clave_Catastral"},  
           {"data":"Estatus",
           render: function (data, type, row ) {
            switch (data) {
                case 'APROBADO':
                  return "<span class='badge bg-success'>"+data+"</span>";
                case 'DESAPROBADO':
                  return "<span class='badge bg-danger'>"+data+"</span>";
                case 'SEGUIMIENTO':
                  return "<span class='badge bg-warning'>"+data+"</span>";
                case 'SOLICITUD DE DOCUMENTACION':
                  return "<span class='badge bg-info'>"+data+"</span>";
                default:
                  return data;
              }              
             } 
           },  
           {"data":"Observaciones"},  
           {"data":"Fecha"},
           {"defaultContent":"<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fas fa-edit' aria-hidden='true'></i></button>"}
       ], 
       "language":idioma_espanol,
       select: true
   });
    document.getElementById("tabla_cich_filter").style.display="none";
    $('input.global_filter').on( 'keyup click', function () {
    filterGlobal();
    } );
    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('tr').attr('data-column') );
    });
}

$('#tabla_cich').on('click','.editar',function(){
    var data = table.row($(this).parents('tr')).data();
    if(table.row(this).child.isShown()){
        var data = table.row(this).data();
    }
    $("#modal_nuevo_editar").modal({backdrop:'static',keyboard:false})
    $("#modal_nuevo_editar").modal('show');
    $("#txt_exp_editar").val(data.Expediente);
    $("#txt_proyect_editar").val(data.Tipo_de_Proyecto);
    $("#txt_prop_editar").val(data.Propietario);
    $("#txt_cat_editar").val(data.Clave_Catastral);
    $("#cbm_estatus_editar").val(data.Estatus).trigger("change");
    $("#txt_obs_editar").val(data.Observaciones);
    $("#txt_fech_editar").val(data.Fecha);
    $("#txt_ing_editar").val(data.Colegiado);
    $("#txt_area_editar").val(data.Area);
    $("#txt_pre_editar").val(data.Presupuesto);
});

function filterGlobal() {
    $('#tabla_cich').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}

function listar_combo_rol_colegio_cich(){
    $.ajax({
        "url":"../controlador/colegios/controlador_combo_rol_colegio_cich.php",
        type:'POST'
    }).done(function(resp){
        let data = JSON.parse(resp);
        let cadena = "";
        if (data.length > 0){
            for(let i=0;i<data.length;i++){
                cadena+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
            }
            $('#cbm_colegio').html(cadena);
        }else{
            cadena+="<option value=''>NO SE ENCONTRARON REGISTROS</option>";
        }
    })
}



function Registrar_Nota_Cich(){
    let exp = $('#txt_exp').val();
    let proye = $('#txt_proyect').val();
    let prop = $('#txt_prop').val();
    let cat = $('#txt_cat').val();
    let area = $('#txt_area').val();
    let presu = $('#txt_pre').val();
    let colegiado = $('#txt_ing').val();
    let obs = $('#txt_obs').val();
    let estatus = $('#cbm_estatus').val();
    let fecha = $('#txt_fech').val();
    if(exp.length == 0 || proye.length == 0 || prop.length == 0 || cat.length == 0 || area.length == 0 || presu.length == 0 || colegiado.length == 0 || estatus.length == 0 || obs.length == 0 || fecha.length == 0){
        return Swal.fire("Advertencia", "Llene los campos vacios","warning");
    }
    $.ajax({
        "url":"../controlador/colegios/controlador_cich_registro.php",
        type:'POST',
        data:{
            expediente:exp,
            proyecto:proye,
            propietario:prop,
            catastral:cat,
            area:area,
            presupuesto:presu,
            colegiado:colegiado,
            estatus:estatus,
            observaciones:obs,
            fecha:fecha,
        }
    }).done(function(resp){
        if(resp>0){
            if(resp==1){
                $('#modal_nuevo_cich').modal('hide');
                Swal.fire("CONFRIMADO", "Nota de Construcción Registrada","success")
                .then((value)=>{
                    LimpiarRegistro();
                    table.ajax.reload();
                });
            }else{
                return Swal.fire("ADVERTENCIA", "La Nota de Construcción ya Existe","warning");
            }
        }else{  
            Swal.fire("ERROR", "No se pudo completar","error");
        }
    })
}

function LimpiarRegistro(){
    $('#txt_exp').val("");
    $('#txt_proyect').val("");
    $('#txt_prop').val("");
    $('#txt_cat').val("");
    $('#cbm_estatus').val("");
    $('#txt_obs').val("");
    $('#txt_fech').val("");
}
