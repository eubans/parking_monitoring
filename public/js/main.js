function loadPageVar(sVar) {
    return decodeURI(
        window.location.search.replace(
            new RegExp(
                "^(?:.*[&\\?]" +
                    encodeURI(sVar).replace(/[\.\+\*]/g, "\\$&") +
                    "(?:\\=([^&]*))?)?.*$",
                "i"
            ),
            "$1"
        )
    );
}

function run_waitMe(effect, element) {
    $(element).waitMe({
        effect: effect,
        text: "",
        bg: "rgba(255,255,255,0.7)",
        color: "#000",
        maxSize: "",
        waitTime: -1,
        source: "",
        textPos: "vertical",
        fontSize: "",
        onClose: function() {}
    });
}
