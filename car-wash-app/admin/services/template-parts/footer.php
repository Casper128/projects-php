    <!-- Bootstrap core JavaScript-->
    <script src="../lib/jquery/jquery.min.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../lib/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>


    <!-- Sweet Alert 2 scripts for all pages-->
    <script>
  document.querySelector('form').addEventListener('submit', function(e) {
    // Validar campos vacíos
    const nombre = document.querySelector('input[name="txtNombre"]').value;
    const usuario = document.querySelector('input[name="txtUsuario"]').value;
    const password = document.querySelector('input[name="txtPassword"]').value;
    const telefono = document.querySelector('input[name="txtTelefono"]').value;

    if (nombre.trim() === '' || usuario.trim() === '' || password.trim() === '' || telefono.trim() === '') {
    e.preventDefault(); 
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Por favor, completa todos los campos del formulario.',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Aceptar'
      });
      return;
    }

});
</script>

</body>

</html>