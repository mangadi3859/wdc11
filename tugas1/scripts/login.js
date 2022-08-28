"use strict";

const toastElement = document.querySelector("#auth-error-toast");
const getQuery = new URLSearchParams(location.search);

if (getQuery.has("error")) {
    let toast = new bootstrap.Toast(toastElement);

    toast.show();
    getQuery.delete("error");
    history.pushState(null, "", location.pathname + "?" + getQuery.toString());
}
