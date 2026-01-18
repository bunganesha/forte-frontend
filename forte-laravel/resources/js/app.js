// import "./bootstrap";
// import L from "leaflet";
// import "leaflet/dist/leaflet.css";

// import icon from "leaflet/dist/images/marker-icon.png";
// import iconShadow from "leaflet/dist/images/marker-shadow.png";

// delete L.Icon.Default.prototype._getIconUrl;

// L.Icon.Default.mergeOptions({
//     iconUrl: icon,
//     shadowUrl: iconShadow,
// });
import Swal from "sweetalert2";
import 'bootstrap-icons/font/bootstrap-icons.css';

window.Swal = Swal;

window.confirmLogout = function () {
    Swal.fire({
        title: "Yakin ingin logout?",
        text: "Kamu akan keluar dari sesi login.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Ya, Logout",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("logout-form").submit();
        }
    });
};
