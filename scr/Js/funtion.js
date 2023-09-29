document.addEventListener("DOMContentLoaded", function() {
    //code for form edit employee
    const btnEditEmployee = document.querySelectorAll("a.btn-tabla-edit");

    btnEditEmployee.forEach(function(btn) {
        btn.addEventListener("click", function(event) {
            event.preventDefault();
            //subo en la gerarquia del DOM para poder obtener datos
            var containerOne = btn.parentNode;
            var fatherContainer = containerOne.parentNode;

            var numberID = fatherContainer.querySelector(".numberID").getAttribute("data-id");
            var employeeID = fatherContainer.querySelector(".employeeID").textContent;
            var employeeName = fatherContainer.querySelector(".employeeName").textContent;
            var employeeSurnames = fatherContainer.querySelector(".employeeSurnames").textContent;
            var employeeAddress = fatherContainer.querySelector(".employeeAddress").textContent;
            var employeePhone = fatherContainer.querySelector(".employeePhone").textContent;

            setDataFormEdit(numberID, employeeID, employeeName, employeeSurnames, employeeAddress, employeePhone);
        });
    });

    //code for modal delete employee
    const btnDeleteEmployee = document.querySelectorAll("a.btn-tabla-delete");
    const contentModalDeleteEmployee = document.querySelector(".contentModalDeleteEmployee"); //se declara el contentModalDeleteEmployee
    const btnCancelDeleteEmployee = document.querySelector("#cerrarModalBtn");

    btnDeleteEmployee.forEach(function(btn) {
        btn.addEventListener("click", function(event) {
            event.preventDefault();
            abrirModal();
        });
    });

    btnCancelDeleteEmployee.addEventListener("click", () => {
        cerrorModal();
    });


    // Función para abrir el modal
    function abrirModal() {
        contentModalDeleteEmployee.style.display = "block";
    }

    // funcion para cerrar el modal
    function cerrorModal() {
        contentModalDeleteEmployee.style.display = "none";
    }
});

const setDataFormEdit = (numberID, employeeID, employeeName, employeeSurnames, employeeAddress, employeePhone) => { 
    const numberIdElement = document.getElementById("txtidEdit");
    const employeeIdElement = document.getElementById("cedulaEdit");
    const employeeNameElement = document.getElementById("nombreEdit");
    const employeeSurnamesElement = document.getElementById("apellidoEdit");
    const employeeAddressElement = document.getElementById("direccionEdit");
    const employeePhoneElement = document.getElementById("telefonoEdit");

    // asignoo los volares del employee a editar
    numberIdElement.value = numberID;
    employeeIdElement.value = employeeID;
    employeeNameElement.value = employeeName;
    employeeSurnamesElement.value = employeeSurnames;
    employeeAddressElement.value = employeeAddress;
    employeePhoneElement.value = employeePhone;
};



