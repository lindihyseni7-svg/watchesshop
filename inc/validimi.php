
<script src="jquery-3.6.0.js"></script>
<script src="jquery.validate.min.js"></script>
<script>
      $("#loginv").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            fjalekalimi: {
                required: true,
                minlength: 6
            }
        },
        messages: {
            fjalekalimi: {
                required: "Ju lutemi vendosni një fjalëkalim",
                minlength: "Fjalëkalimi duhet të jetë të paktën 6 karaktere"
            },
            email: {
                required: "Ju lutemi vendosni një adresë emaili",
                email: "Ju lutemi vendosni një adresë emaili të vlefshme"
            },
        }
    }); 
</script><script src="jquery-3.6.0.js"></script>
<script src="jquery.validate.min.js"></script>
<script>
    $("#perdoruesi").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            fjalekalimi: {
                required: true,
                minlength: 6
            },
            emri: {
                required: true,
                minlength: 3
            },
            mbiemri: {
                required: true,
                minlength:3
            },
            roli: {
                required: true
            },
            nrpersonal: {
                required: true,
                number: true
            },
            telefoni: {
                required: true,
                number: true
            }
        },
        messages: {
            fjalekalimi: {
                required: "Ju lutemi vendosni një fjalëkalim",
                minlength: "Fjalëkalimi duhet të jetë të paktën 6 karaktere"
            },
            email: {
                required: "Ju lutemi vendosni një adresë emaili",
                email: "Ju lutemi vendosni një adresë emaili të vlefshme"
            },
            emri: {
                required: "Ju lutemi vendosni një emër",
                minlength: "Emri duhet të jetë të paktën 3 karaktere"
            },
            mbiemri: {
                required: "Ju lutemi vendosni një mbiemër",
                minlength: "Mbiemri duhet të jetë të paktën 3 karaktere"
            },
            roli: {
                required: "Ju lutemi vendosni një rol"
            },
            nrpersonal: {
                required: "Ju lutemi vendosni një numër personal",
                number: "Vlera e numrit personal duhet të jetë një numër"
            },
            telefoni: {
                required: "Ju lutemi vendosni një numër telefoni",
                number: "Vlera e telefonit personal duhet të jetë një numër"

            }
        }
    });
</script>
<script>
    $("#regjistrohu").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            fjalekalimi: {
                required: true,
                minlength: 6
            },
            emri: {
                required: true,
                minlength: 3
            },
            mbiemri: {
                required: true,
                minlength:3
            },
            roli: {
                required: true
            },
            nrpersonal: {
                required: true,
                number: true
            },
            telefoni: {
                required: true,
                number: true
            }
        },
        messages: {
            fjalekalimi: {
                required: "Ju lutemi vendosni një fjalëkalim",
                minlength: "Fjalëkalimi duhet të jetë të paktën 6 karaktere"
            },
            email: {
                required: "Ju lutemi vendosni një adresë emaili",
                email: "Ju lutemi vendosni një adresë emaili të vlefshme"
            },
            emri: {
                required: "Ju lutemi vendosni një emër",
                minlength: "Emri duhet të jetë të paktën 3 karaktere"
            },
            mbiemri: {
                required: "Ju lutemi vendosni një mbiemër",
                minlength: "Mbiemri duhet të jetë të paktën 3 karaktere"
            },
            roli: {
                required: "Ju lutemi vendosni një rol"
            },
            nrpersonal: {
                required: "Ju lutemi vendosni një numër personal",
                number: "Vlera e numrit personal duhet të jetë një numër"
            },
            telefoni: {
                required: "Ju lutemi vendosni një numër telefoni",
                number: "Vlera e telefonit personal duhet të jetë një numër"

            }
        }
    });
</script>
<script src="jquery-3.6.0.js"></script>
<script src="jquery.validate.min.js"></script>
<script>
    $("#kategoria").validate({
        rules: {
            kostoja: {
                required: true,
                minlength: 2
            },
            pershkrimi: {
                required: true,
                minlength: 10
            },
            emri: {
                required: true,
                minlength: 5
            }
        },
        messages: {
            kostoja: {
                required: "Ju lutemi vendosni një kosto",
                minlength: "Kostoja duhet të jetë të paktën 2 karaktere"
            },
            pershkrimi: {
                required: "Ju lutemi vendosni një pershkrimi",
                minlength: "Pershkrimi duhet të jetë të paktën 10 karaktere"
            },
            emri: {
                required: "Ju lutemi vendosni një emër",
                minlength: "Emri duhet të jetë të paktën 5 karaktere"
            }
        }
    });
</script>
<script>
    $("#oferta").validate({
        rules: {
            emriofertes: {
                required: true,
                minlength: 5
            },
            zbritja: {
                required: true,
                number: true
            },
            datafillimit: {
                required: true,
                date: true
            },
            dataskadimit: {
                required: true,
                date: true
            }
        },
        messages: {
            emriofertes: {
                required: "Ju lutemi vendosni emrin e ofertës",
                minlength: "Emri i ofertës duhet të jetë të paktën 5 karaktere"
            },
            zbritja: {
                required: "Ju lutemi vendosni vlerën e zbritjes",
                number: "Vlera e zbritjes duhet të jetë një numër"
            },
            datafillimit: {
                required: "Ju lutemi vendosni datën e fillimit",
                date: "Ju lutemi vendosni një datë të vlefshme"
            },
            dataskadimit: {
                required: "Ju lutemi vendosni datën e skadimit",
                date: "Ju lutemi vendosni një datë të vlefshme"
            }
        }
    });
</script>
<script src="jquery-3.6.0.js"></script>
<script src="jquery.validate.min.js"></script>
<script>
    $(document).ready(function () {
        $("#brendet").validate({
            rules: {
                emribrendit: {
                    required: true,
                    minlength: 5
                },
                vitthemelimi: {
                    required: true,
                    minlength: 4,
                    maxlength: 4,
                    digits: true
                },
                vendndodhja: {
                    required: true,
                    minlength: 5
                },
                website: {
                    required: true,
                    url: true
                }
            },
            messages: {
                emribrendit: {
                    required: "Ju lutemi vendosni një emër brendi",
                    minlength: "Emri brendit duhet të jetë të paktën 5 karaktere"
                },
                vitthemelimi: {
                    required: "Ju lutemi vendosni vitin e themelimit",
                    minlength: "Viti i themelimit duhet të jetë 4 karaktere",
                    maxlength: "Viti i themelimit duhet të jetë 4 karaktere",
                    digits: "Viti i themelimit duhet të jetë një numër"
                },
                vendndodhja: {
                    required: "Ju lutemi vendosni vendndodhjen e brendit",
                    minlength: "Vendndodhja duhet të jetë të paktën 5 karaktere"
                },
                website: {
                    required: "Ju lutemi vendosni një website valid",
                    url: "Ju lutemi vendosni një website të vlefshëm"
                }
            }
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $("$oferta").ready(function () {
        $("#oferta").submit(function (event) {
            var dataFillimit = new Date($("#datafillimit").val());
            var dataSkadimit = new Date($("#dataskadimit").val());

            if (dataFillimit > dataSkadimit) {
                alert("Data e fillimit duhet të jetë më e madhe se data e skadimit.");
                event.preventDefault();
            }
        });
    });
</script>

