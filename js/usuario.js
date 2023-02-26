function VerificarUsuario(){
    let usu = $("#txt_usu").val();
    let con = $("#txt_con").val();


    if (usu.length==0 || con.length==0){
        return Swal.fire("Advertencia", "Llene los campos vacios","warning");
    }
    $.ajax({
        url:'../controlador/usuario/controlador_verificar_usuario.php',
        type: 'POST',
        data:{
            user:usu,
            pass:con
        }
    }).done(function(resp){
        if(resp==0){
             Swal.fire("ERROR", "Usuario y/o contrase\u00f1a incorrecta","error");
        }else{
            let data = JSON.parse(resp);
            if (data[0][5]==='INACTIVO'){
                return Swal.fire("Advertencia", "Lo sentimos el usuario "+usu+" se encuentra suspendido, comuniquese con el administrador.","warnign");
            }
            $.ajax({
                url:'../controlador/usuario/controlador_crear_session.php',
                type: 'POST',
                data:{
                    idusuario:data[0][0],
                    user:data[0][1],
                    rol:data[0][6]
                }
            }).done(function(resp){
                let timerInterval
                Swal.fire({
                title: 'Bienvenido a SAAT',
                html: 'Redireccionando.',
                timer: 1000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
                }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    location.reload();
                }
                })
            })
        }
    })
}