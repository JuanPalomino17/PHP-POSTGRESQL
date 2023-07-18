$(document).ready(function () {
  tablaPersonas = $("#tablaPersonas").DataTable({
    "columnDefs": [{
      "targets": -1,
      "data": null,
      "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"
    }],

    "language": {
      "lengthMenu": "Mostrar _MENU_ registros",
      "zeroRecords": "No se encontraron resultados",
      "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
      "infoFiltered": "(filtrado de un total de _MAX_ registros)",
      "sSearch": "Buscar:",
      "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
      },
      "sProcessing": "Procesando...",
    }
  });

  $("#btnNuevo").click(function () {
    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-color", "#0000FF");
    $(".modal-header").css("color", "white");
    $(".modal-title").html("<b>Nuevo</b>");
    $("#modalCRUD").modal("show");
    id = null;
    opcion = 1; //alta
  });

  var fila; //capturar la fila para editar o borrar el registro
  var id;
  //botón EDITAR
  $(document).on("click", ".btnEditar", function () {
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    nombre = fila.find('td:eq(1)').text();
    telefono = fila.find('td:eq(2)').text();
    correo = fila.find('td:eq(3)').text();

    $("#nombre").val(nombre);
    $("#telefono").val(telefono);
    $("#correo").val(correo);
    opcion = 2; //editar

    $(".modal-header").css("background-color", "#0000FF");
    $(".modal-header").css("color", "white");
    $(".modal-title").html("<b>Editar</b>");
    $("#modalCRUD").modal("show");

  });

  // Evento click para abrir el modal Borrar
  $(document).on("click", ".btnBorrar", function () {
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3; //borrar
    $(".modal-title").html("<b>Eliminar</b>");
    $(".modal-header").css("background-color", "#0000FF");
    $(".modal-header").css("color", "white");
    $("#modalBorrar").modal("show");
  });

  // Manejar el evento de clic en el botón "Eliminar" del modal de eliminación
  $(document).on("click", "#btnConfirmarEliminar", function () {
    $.ajax({
      url: "bd/crud.php",
      type: "POST",
      dataType: "json",
      data: { opcion: opcion, id: id },
      success: function () {
        tablaPersonas.row(fila.parents("tr")).remove().draw();
        $("#modalBorrar").modal("hide");
        // Agregar Sweet Alert de "Registro eliminado exitosamente"
        Swal.fire({
          icon: "success",
          title: "Registro eliminado exitosamente.",
          confirmButtonColor: "#0000FF",
          confirmButtonText: "OK",
        });
      }
    });
  });

  // Manejar el envío del formulario
  $(document).on("submit", "#formPersonas", function (e) {
    e.preventDefault();
    nombre = $.trim($("#nombre").val());
    telefono = $.trim($("#telefono").val());
    correo = $.trim($("#correo").val());

    $.ajax({
      url: "bd/crud.php",
      type: "POST",
      dataType: "json",
      data: {
        id: id,
        nombre: nombre,
        telefono: telefono,
        correo: correo,
        opcion: opcion
      },
      success: function (data) {
          id = data[0].id;
          nombre = data[0].nombre;
          telefono = data[0].telefono;
          correo = data[0].correo;
          if (opcion == 1) {
            tablaPersonas.row.add([id, nombre, telefono, correo]).draw();
            $("#modalCRUD").modal("hide");
            // Agregar Sweet Alert de "Registro guardado exitosamente"
            Swal.fire({
              icon: "success",
              title: "Registro guardado exitosamente.",
              confirmButtonColor: "#0000FF",
              confirmButtonText: "OK",
            });
          } else if(opcion == 2){
            tablaPersonas.row(fila).data([id, nombre, telefono, correo]).draw();
            $("#modalCRUD").modal("hide");
            // Agregar Sweet Alert de "Registro modificado exitosamente"
            Swal.fire({
              icon: "success",
              title: "Registro modificado exitosamente.",
              confirmButtonColor: "#0000FF",
              confirmButtonText: "OK",
            });
          }
      }
    });
  });
 
});
