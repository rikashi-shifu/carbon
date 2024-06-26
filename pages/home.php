<?php
session_start();


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Carbon</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Chonburi&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Dosis:wght@300&family=Quicksand:wght@300&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../styles.css" />
    <link rel="stylesheet" href="../css/admin.css" />
  </head>
  <body style="height: 100dvh">
    <header
      class="d-flex justify-content-between position-fixed w-100 z-1 border"
      style="height: 70px"
    >
      <a
        href="home.php"
        class="d-flex justify-content-center align-items-center w-25 text-decoration-none"
        style="margin-left: 10px"
      >
        <div>
          <img
            src="../img/nav/logo.png"
            alt="logo"
            width="60px"
            height="60px"
            style="
              filter: invert(38%) sepia(53%) saturate(604%) hue-rotate(100deg)
                brightness(99%) contrast(91%);
            "
          />
        </div>
        <h4 class="dropdown-item text-black mb-0">Carbon</h4>
      </a>

      <nav class="d-flex gap-3 align-items-center justify-content-between">
        <a
          href="home.php"
          class="nav-link"
          onmouseover="this.style.color='#198754'"
          onmouseout="this.style.color='#000'"
          >Home</a
        >
        <a
          href="dashboard.php"
          class="nav-link"
          onmouseover="this.style.color='#198754'"
          onmouseout="this.style.color='#000'"
          >Dashboard</a
        >
        <a
          href="learn.html"
          target="_blank"
          class="nav-link"
          onmouseover="this.style.color='#198754'"
          onmouseout="this.style.color='#000'"
          >Learn</a
        >
      </nav>
      <div
        class="dropdown pe-3 d-flex justify-content-end align-items-center w-25"
      >
        <div class="btn-group border">
          <a
            href="profile.php"
            class="btn"
            onmouseover="this.style.backgroundColor = '#f8f9fa'"
            onmouseleave="this.style.backgroundColor = 'white'"
          >
            <i class="bi bi-person-fill"></i>
          </a>
          <button
            class="btn dropdown-toggle dropdown-toggle-split"
            type="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
            onmouseover="this.style.backgroundColor = '#f8f9fa'"
            onmouseleave="this.style.backgroundColor = 'white'"
          ></button>
          <ul class="dropdown-menu mt-2">
            <a class="dropdown-item btn" href="event.php" target="_blank">Event</a>
            <button
              type="button"
              class="dropdown-item btn"
              data-bs-toggle="modal"
              data-bs-target="#feedback"
            >
              Feedback
            </button>
            <a
              class="dropdown-item btn"
              onmouseover="this.style.backgroundColor = '#b23b3b'; this.style.color = 'white'"
              onmouseleave="this.style.backgroundColor = 'white'; this.style.color = 'black'"
              href="../index.html"
              >Sign out</a
            >
          </ul>
        </div>
      </div>
    </header>

    <!-- modal -->
    <div
      class="modal fade"
      id="feedback"
      tabindex="-1"
      aria-labelledby="feedbackLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="feedbackLabel">Feedback</h1>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
              onclick="clearFeedback()"
            ></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label"
                  >Subject:</label
                >
                <input
                  type="text"
                  class="form-control"
                  id="feedback-subject"
                  oninput="feedbackValidation()"
                />
              </div>
              <div class="mb-3">
                <label for="message-text" class="col-form-label"
                  >Message:</label
                >
                <textarea
                  class="form-control"
                  id="feedback-message"
                  oninput="feedbackValidation()"
                ></textarea>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
              onclick="clearFeedback()"
            >
              Close
            </button>
            <button
              id="toast-btn"
              type="button"
              class="btn btn-success"
              data-bs-dismiss="modal"
              disabled
              onclick="clearFeedback(); showToast()"
            >
              Send feedback
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- toast -->
    <div
      id="toast"
      class="toast position-absolute bottom-0 end-0 m-3"
      role="alert"
      aria-live="assertive"
      aria-atomic="true"
    >
      <div class="d-flex">
        <div class="toast-body">Feedback submitted!</div>
        <button
          type="button"
          class="btn-close me-2 m-auto"
          data-bs-dismiss="toast"
          aria-label="Close"
          onclick="closeToast()"
        ></button>
      </div>
    </div>

    <main class="h-100 d-flex justify-content-center align-items-center">
      <div class="d-flex justify-content-center align-items-center w-75">
        <div class="d-flex flex-column gap-3 p-5" style="width: 50%">
          <h1
            class="display-3 fw-bolder z-1"
            style="font-family: choburi, serif"
          >
            Calculate your carbon footprint
          </h1>
          <div
            class="progress rounded-5"
            style="width: 85%; height: 20px"
            role="progressbar"
            aria-label="Animated striped"
            aria-valuenow="75"
            aria-valuemin="0"
            aria-valuemax="100"
          >
            <div
              id="progress-bar"
              class="progress-bar progress-bar-striped progress-bar-animated bg-success"
              style="width: 0%"
            ></div>
          </div>
        </div>
        <form
          id="carousel"
          class="d-flex carousel carousel-dark slide rounded-5 mt-5 border border-5 overflow-hidden shadow needs-validation"
          style="width: 50%; background-color: white"
          action="../api/home-post.php"
          method="POST"
        >
          <div class="carousel-inner" style="height: 60dvh">
            <!-- slide 0 -->
            <div class="carousel-item h-100 slide-0">
              <div class="d-flex justify-content-center align-items-center border h-100 p-5">
                <h1 class="display-1 fs-1">Good thing takes time, do it again tomorrow!</h1>
              </div>
            </div>

            <!-- slide 1 -->
            <div
              class="carousel-item h-100 position-relative slide-1 active"
              data-prev-btn-state="disabled"
              data-next-btn-state="disabled"
            >
              <div
                class="d-flex justify-content-center align-items-center position-absolute top-50 start-50"
                style="transform: translate(-50%, -50%)"
              >
                <div
                  class="d-flex flex-column justify-content-center align-items-center gap-3 fs-2"
                  style="width: 350px"
                >
                  <label for="monthlyElectricBill" class="form-label"
                    >What's your monthly electric bill?</label
                  >
                  <input
                    id="monthlyElectricBill"
                    class="form-control"
                    type="number"
                    name="monthlyElectricBill"
                    placeholder="$"
                    oninput="getBtnState('.carousel-item.active'); setBtnState(this); inputValidation(this)"
                  />
                  <div
                    class="invalid-feedback"
                    style="font-size: 12px; margin-top: -15px"
                  >
                    Please provide a valid monthly electric bill.
                  </div>
                </div>
              </div>
            </div>
            <!-- slide 2 -->
            <div
              class="carousel-item h-100 position-relative slide-2"
              data-prev-btn-state="enabled"
              data-next-btn-state="disabled"
            >
              <div
                class="d-flex justify-content-center align-items-center position-absolute top-50 start-50"
                style="transform: translate(-50%, -50%)"
              >
                <div
                  class="d-flex flex-column justify-content-center align-items-center gap-3 fs-2"
                  style="width: 350px"
                >
                  <label for="monthlyGasBill" class="form-label"
                    >What's your monthly gas bill?</label
                  >
                  <input
                    id="monthlyGasBill"
                    class="form-control"
                    name="monthlyGasBill"
                    type="number"
                    placeholder="$"
                    oninput="getBtnState('.carousel-item.active'); setBtnState(this); inputValidation(this)"
                  />
                </div>
              </div>
            </div>
            <!-- slide 3 -->
            <div
              class="carousel-item h-100 position-relative slide-3"
              data-prev-btn-state="enabled"
              data-next-btn-state="disabled"
            >
              <div
                class="d-flex justify-content-center align-items-center position-absolute top-50 start-50"
                style="transform: translate(-50%, -50%)"
              >
                <div
                  class="d-flex flex-column justify-content-center align-items-center gap-3 fs-2"
                  style="width: 350px"
                >
                  <label for="monthlyOilBill" class="form-label"
                    >What's your monthly oil bill?</label
                  >
                  <input
                    id="monthlyOilBill"
                    class="form-control"
                    name="monthlyOilBill"
                    type="number"
                    placeholder="$"
                    oninput="getBtnState('.carousel-item.active'); setBtnState(this); inputValidation(this)"
                  />
                </div>
              </div>
            </div>
            <!-- slide 4 -->
            <div
              class="carousel-item h-100 position-relative slide-4"
              data-prev-btn-state="enabled"
              data-next-btn-state="disabled"
            >
              <div
                class="d-flex justify-content-center align-items-center position-absolute top-50 start-50"
                style="transform: translate(-50%, -50%)"
              >
                <div
                  class="d-flex flex-column justify-content-center align-items-center gap-3 fs-2"
                  style="width: 350px"
                >
                  <label for="totalMileage" class="form-label"
                    >What's your total mileage on your car?</label
                  >
                  <input
                    id="totalMileage"
                    class="form-control"
                    name="totalMileage"
                    type="number"
                    oninput="getBtnState('.carousel-item.active'); setBtnState(this); inputValidation(this); totalMileageValidation(this)"
                  />
                  <div
                    class="invalid-feedback"
                    style="font-size: 13px; margin-top: -15px"
                  >
                    Please enter a valid total mileage.
                  </div>
                </div>
              </div>
            </div>
            <!-- slide 5 -->
            <div
              class="carousel-item h-100 position-relative slide-5"
              data-prev-btn-state="enabled"
              data-next-btn-state="disabled"
            >
              <div
                class="d-flex justify-content-center align-items-center position-absolute top-50 start-50"
                style="transform: translate(-50%, -50%)"
              >
                <div
                  class="d-flex flex-column justify-content-center align-items-center gap-3 fs-2"
                  style="width: 350px"
                >
                  <label for="totalYear" class="form-label"
                    >How many years you have own this car?</label
                  >
                  <input
                    id="totalYear"
                    class="form-control"
                    type="number"
                    name="totalYear"
                    oninput="getBtnState('.carousel-item.active'); setBtnState(this); inputValidation(this); totalYearValidation(this); yearlyMileageValidation()"
                  />
                  <div
                    id="totalYearFeedback"
                    class="invalid-feedback"
                    style="font-size: 13px; margin-top: -15px"
                  >
                    You must own this car at least a year to have car mileage.
                  </div>
                </div>
              </div>
            </div>
            <!-- slide 6 -->
            <div
              class="carousel-item h-100 position-relative slide-6"
              data-prev-btn-state="enabled"
              data-next-btn-state="disabled"
            >
              <div
                class="d-flex justify-content-center align-items-center position-absolute top-50 start-50"
                style="transform: translate(-50%, -50%)"
              >
                <div
                  class="d-flex flex-column justify-content-center align-items-center gap-3 fs-3"
                  style="width: 350px"
                >
                  <label for="numberOfFlights" class="form-label"
                    >What's the number of flights you've taken before?</label
                  >
                  <input
                    id="numberOfFlights"
                    class="form-control"
                    name="numberOfFlights"
                    type="number"
                    oninput="getBtnState('.carousel-item.active'); setBtnState(this); inputValidation(this)"
                  />
                </div>
              </div>
            </div>
            <!-- slide 7 -->
            <div
              class="carousel-item h-100 position-relative slide-7"
              data-prev-btn-state="enabled"
              data-next-btn-state="enabled"
            >
              <div
                class="d-flex gap-3 justify-content-center align-items-center position-absolute top-50 start-50 fs-4"
                style="transform: translate(-50%, -50%)"
              >
                <label for="recycleNewspaper" class="form-label w-75"
                  >Do you recycle newspaper?</label
                >
                <div class="btn-group w-25" role="group">
                  <input
                    type="radio"
                    class="btn-check btn-lg"
                    name="recycleNewspaper"
                    id="doRecycleNewspaper"
                    value="true"
                    autocomplete="off"
                    checked
                  />
                  <label
                    class="btn btn-outline-success"
                    for="doRecycleNewspaper"
                    >Yes</label
                  >

                  <input
                    type="radio"
                    class="btn-check"
                    name="recycleNewspaper"
                    id="dontRecycleNewspaper"
                    value="false"
                    autocomplete="off"
                  />
                  <label
                    class="btn btn-outline-success"
                    for="dontRecycleNewspaper"
                    >No</label
                  >
                </div>
              </div>
            </div>
            <!-- slide 8 -->
            <div
              class="carousel-item h-100 position-relative slide-8"
              data-prev-btn-state="enabled"
              data-next-btn-state="enabled"
            >
              <div
                class="d-flex justify-content-center align-items-center position-absolute top-50 start-50 fs-5"
                style="transform: translate(-50%, -50%)"
              >
                <label for="recycleAluminiumAndTin" class="form-label w-75"
                  >Do you recycle aluminium and tin?</label
                >
                <div class="btn-group w-25" role="group">
                  <input
                    type="radio"
                    class="btn-check"
                    name="recycleAluminiumAndTin"
                    id="doRecycleAluminiumAndTin"
                    value="true"
                    autocomplete="off"
                    checked
                  />
                  <label
                    class="btn btn-outline-success"
                    for="doRecycleAluminiumAndTin"
                    >Yes</label
                  >
                  <input
                    type="radio"
                    class="btn-check"
                    name="recycleAluminiumAndTin"
                    id="dontRecycleAluminiumAndTin"
                    value="false"
                    autocomplete="off"
                  />
                  <label
                    class="btn btn-outline-success"
                    for="dontRecycleAluminiumAndTin"
                    >No</label
                  >
                </div>
              </div>
            </div>
          </div>
          <button
            id="prev-btn"
            class="carousel-control-prev border rounded"
            style="width: 90px; height: fit-content; top: 80%; left: 30%"
            type="button"
            data-bs-target="#carousel"
            data-bs-slide="prev"
            disabled
            onclick="getBtnState('.carousel-item-prev'); autoFocusCurrentInput(); handleSubmitBtnStyling()"
          >
            <span
              class="carousel-control-prev-icon visually-hidden"
              aria-hidden="true"
            ></span>
            <span class="btn text-black w-100">Previous</span>
          </button>
          <button
            id="next-btn"
            class="carousel-control-next border rounded"
            style="width: 90px; height: fit-content; top: 80%; left: 50%"
            type="button"
            data-bs-target="#carousel"
            data-bs-slide="next"
            disabled
            onclick="getBtnState('.carousel-item-next'); autoFocusCurrentInput(); handleSubmitBtnStyling(); handleSubmitBtn(); validationForEmptyField()"
          >
            <span
              class="carousel-control-next-icon visually-hidden"
              aria-hidden="true"
            ></span>
            <span id="submit-btn" class="btn text-black w-100">Next</span>
          </button>
        </form>
      </div>
    </main>
    
    <script src="../scripts/home.js?v=<?php echo time(); ?>"></script>
    <script src="../scripts/feedback.js?v=<?php echo time(); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
