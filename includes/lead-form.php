<?php $leadFormSectionClass = !empty($leadFormCompact) ? ' lead-form-section--compact' : ''; ?>
<section id="lead-form-section" class="<?= $leadFormSectionClass ?>">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="contact-details">
                    <div class="pbmit-heading-subheading">
                        <h4 class="pbmit-subtitle">GET IN TOUCH</h4>
                        <h2 class="pbmit-title">Prepare for<br> Your Next Step in Georgia!

                        </h2>
                    </div>




                    <div class="tettttt">



                        <p>Schedule your <strong>free 30-minute consultation today</strong>, and let us
                            assist you in planning a tailored solution that meets your specific needs.
                            Whether you are considering relocation, exploring investment opportunities, or
                            seeking legal guidance on Georgian regulations, our experienced team is here to
                            provide comprehensive support.<br><br>

                            We typically respond within one hour, ensuring timely communication as we guide
                            you through every step of the process.</p>



                    </div>





                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-form jklll">
                    <div class="pbmit-heading-subheading">
                        <h4 class="pbmit-subtitle">PLEASE Fill Form</h4>
                        <h2 class="pbmit-title text-white">Get In Touch With Us Now

                        </h2>


                    </div>

                    <?php if (isset($_GET["lead_submitted"]) && $_GET["lead_submitted"] === "1"): ?>
                        <div class="alert alert-success js-lead-flash-alert mb-3" data-flash-param="lead_submitted">
                            Your enquiry has been sent successfully.
                        </div>
                    <?php endif; ?>

                    <form method="post" action="backend/contact-form.php">

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                <input name="name" type="text" class="form-control" placeholder="Name *"
                                    value="<?php if(isset($name)){ echo $name; } ?>" required>
                                <?php if(isset($error['name'])){ echo $error['name']; }?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                <input name="email" type="email" class="form-control" placeholder="Email *"
                                    value="<?php if(isset($email)){ echo $email; } ?>" required>
                                <?php if(isset($error['email'])){ echo $error['email']; }?>
                            </div>
                        </div>


                        <div class="row clearfix">


                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <select name="service" class="form-control" required>
                                    <option value="">--Select Service -- </option>
                                    <option value="Company Registration Packages"
                                        <?php if(isset($_POST['service']) && $_POST['service']=="Company Registration Packages"){ echo "selected='selected'";} ?>>
                                        Company Registration Packages</option>
                                    <option value="Accounting & Taxation"
                                        <?php if(isset($_POST['service']) && $_POST['service']=="Accounting & Taxation"){ echo "selected='selected'";} ?>>
                                        Accounting & Taxation</option>
                                    <option value="Resident Permit"
                                        <?php if(isset($_POST['service']) && $_POST['service']=="Resident Permit"){ echo "selected='selected'";} ?>>
                                        Resident Permit</option>
                                    <option value="Bank Account Opening"
                                        <?php if(isset($_POST['service']) && $_POST['service']=="Bank Account Opening"){ echo "selected='selected'";} ?>>
                                        Bank Account Opening</option>
                                    <option value="Tax Residency"
                                        <?php if(isset($_POST['service']) && $_POST['service']=="Tax Residency"){ echo "selected='selected'";} ?>>
                                        Tax Residency</option>
                                    <option value="Individual Entrepreneur"
                                        <?php if(isset($_POST['service']) && $_POST['service']=="Individual Entrepreneur"){ echo "selected='selected'";} ?>>
                                        Individual Entrepreneur</option>
                                    <option value="Nominee Services"
                                        <?php if(isset($_POST['service']) && $_POST['service']=="Nominee Services"){ echo "selected='selected'";} ?>>
                                        Nominee Services</option>

                                </select>
                                <?php if(isset($error['service'])){ echo $error['service']; }?>
                            </div>
                        </div>


                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">

                                <textarea name="message" rows="4" class="form-control" placeholder=" Message *"
                                    required><?php if(isset($message)){ echo $message; } ?>
</textarea>
                                <?php if(isset($error['message'])){ echo $error['message']; }?>


                            </div>
                        </div>
                        <div class="row clearfix">

                            <div class="col-md-12 col-lg-6">
                                <button type="submit" name="submit"
                                    class="pbmit-btn pbmit-btn-global pbmit-btn-shape-round w-100 jkl">
                                    <i
                                        class="form-btn-loader fa fa-circle-o-notch fa-spin fa-fw margin-bottom d-none"></i>
                                    SEND MESSAGE
                                </button>
                            </div>
                            <div class="col-md-12 col-lg-12 message-status"></div>
                        </div>
                    </form>

                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            const leadAlert = document.querySelector(".js-lead-flash-alert");
                            if (!leadAlert) {
                                return;
                            }

                            const url = new URL(window.location.href);
                            const paramName = leadAlert.getAttribute("data-flash-param");

                            if (paramName && url.searchParams.has(paramName)) {
                                url.searchParams.delete(paramName);
                                let cleanPath = url.pathname;
                                if (cleanPath.endsWith("/index")) {
                                    cleanPath = cleanPath.slice(0, -6) || "/";
                                }

                                const cleanedUrl = cleanPath + (url.searchParams.toString() ? "?" + url.searchParams.toString() : "") + url.hash;
                                window.history.replaceState({}, document.title, cleanedUrl);
                            }

                            window.setTimeout(function () {
                                leadAlert.style.transition = "opacity 0.4s ease";
                                leadAlert.style.opacity = "0";
                                window.setTimeout(function () {
                                    leadAlert.remove();
                                }, 400);
                            }, 3000);
                        });
                    </script>
















                </div>
            </div>
        </div>
    </div>
</section>
