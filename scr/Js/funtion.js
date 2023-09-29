var n = 0; // variable que controla el evento de ecultar el modal delete employee solo cuando este abierto

document.addEventListener("DOMContentLoaded", function () {
    //code for form edit employee
    const btnEditEmployee = document.querySelectorAll("a.btn-tabla-edit");

    btnEditEmployee.forEach(function (btn) {
        btn.addEventListener("click", function (event) {
            event.preventDefault();
            const data = obtenerDatos(btn); //asignamos los datos que retornla la funcion a una variable para poder usarla
            setDataFormEdit(data.numberID, data.employeeID, data.employeeName, data.employeeSurnames, data.employeeAddress, data.employeePhone);
        });
    });

    //code for modal delete employee
    const btnDeleteEmployee = document.querySelectorAll("a.btn-tabla-delete");
    const btnCancelDeleteEmployee = document.querySelector("#cerrarModalBtn");
    const contentModalDeleteEmployee = document.querySelector(".contentModalDeleteEmployee"); //se declara el contentModalDeleteEmployee
    const ModalDeleteEmployee = document.getElementById("modal-delete-employee");
    
    btnDeleteEmployee.forEach(function (btn) {
        btn.addEventListener("click", function (event) {
            event.preventDefault();
            abrirModal(btn, contentModalDeleteEmployee);
        });
    });

    btnCancelDeleteEmployee.addEventListener("click", () => {
        cerrorModal(contentModalDeleteEmployee);
    });
});

document.addEventListener("click", function (e) {
    const contentModalDeleteEmployee = document.querySelector(".contentModalDeleteEmployee"); //se declara el contentModalDeleteEmployee
    const ModalDeleteEmployee = document.getElementById("modal-delete-employee");
    //obtiene el estilo calculado del modal
    let estilo = window.getComputedStyle(contentModalDeleteEmployee);
    //verifica si el modal está visible y el clic fue fuera del contenido
    if (estilo.display == "block" && !ModalDeleteEmployee.contains(e.target)) {
        if (n == 0) {
            n = 1;
        } else {
            // cerramos contentModalDeleteEmployee
            cerrorModal(contentModalDeleteEmployee);
        }
    }
});

// Función para abrir el modal
function abrirModal(btn, content) {
    const data = obtenerDatos(btn);
    setDataModalEmployee(data.numberID, data.employeeID, data.employeeName, data.employeeSurnames, data.employeeAddress, data.employeePhone);
    content.style.display = "block";
}

// funcion para cerrar el modal
function cerrorModal(content) {
    content.style.display = "none";
    n = 0;
}

// Funcion que resive a l btn y retorna los datos del contenedor donde se aloja
function obtenerDatos(btn) {
    // Obtener el contenedor del botón
    var containerOne = btn.parentNode;
    // Obtener el contenedor padre del contenedor del botón
    var fatherContainer = containerOne.parentNode;
    // Obtener el número de identificación del empleado
    var numberID = fatherContainer.querySelector(".numberID").getAttribute("data-id");
    // Obtener el ID, el nombre, los apellidos, la dirección y el teléfono del empleado
    var employeeID = fatherContainer.querySelector(".employeeID").textContent;
    var employeeName = fatherContainer.querySelector(".employeeName").textContent;
    var employeeSurnames = fatherContainer.querySelector(".employeeSurnames").textContent;
    var employeeAddress = fatherContainer.querySelector(".employeeAddress").textContent;
    var employeePhone = fatherContainer.querySelector(".employeePhone").textContent;
    // Crear un objeto con los datos del empleado
    var employeeData = {
        numberID: numberID,
        employeeID: employeeID,
        employeeName: employeeName,
        employeeSurnames: employeeSurnames,
        employeeAddress: employeeAddress,
        employeePhone: employeePhone
    };
    // Retornar el objeto con los datos del empleado
    return employeeData;
}


//envia la informacion que le paso a formulario de edit employee
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

//envia la informacion al modal delete employee
const setDataModalEmployee = (numberID, employeeID, employeeName, employeeSurnames, employeeAddress, employeePhone) => {
    //selecciona los elementos por su id
    let nameDelete = document.getElementById("nameDelete");
    let phoneDelete = document.getElementById("phoneDelete");
    let adressDelete = document.getElementById("adressDelete");
    let idEmployeeDelete = document.getElementById("idEmployeeDelete");
    let btnAceptDeleteEmployee = document.getElementById("btnAceptDeleteEmployee");
    //cambia el contenido de los elementos con la información recibida
    nameDelete.textContent = "Name: " + employeeName + " " + employeeSurnames;
    phoneDelete.textContent = "Telephone: " + employeePhone;
    adressDelete.textContent = "Adress: " + employeeAddress;
    idEmployeeDelete.textContent = "ID: " + employeeID;
    //modifico el href de a con el id del que se va a eliminar
    btnAceptDeleteEmployee.setAttribute("href", "index.php?id=" + numberID);
}



