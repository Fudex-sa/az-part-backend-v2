




              <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                <div class="row">
                  <div class="col-md-12">
                    <div class="btn-add-container float-left">
                      <!-- Large modal -->
                      <button type="button" class="btn btn-save" data-toggle="modal"
                        data-target=".bd-example-modal-lg">+ أضف سيارة </button>

                      <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content modal-padding">
                            <div class="head-section">
                              <h2>ادخل تفاصيل السيارة</h2>
                              <h4 class="mt-5">تفاصيل السيارة
                              </h4>
                            </div>
                            <form class="mt-3 pop-margin">
                              <div class="form-group">
                                <select class="form-control" id="exampleFormControlSelect11">
                                  <option selected disabled>الماركة</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                                  <option>5</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <select class="form-control" id="exampleFormControlSelect22">
                                  <option selected disabled>الموديل</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                                  <option>5</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <select class="form-control" id="exampleFormControlSelect33">
                                  <option selected disabled>سنة الصنع</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                                  <option>5</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <input type="text" class="form-control" id="add" placeholder="العنوان">
                              </div>
                              <div class="form-group">
                                <input type="text" class="form-control" id="color2" placeholder="اللون">
                              </div>
                              <div class="form-group">
                                <input type="text" class="form-control" id="kilos" placeholder="عدد الكيلومترات">
                              </div>
                              <div class="form-group">
                                <select class="form-control" id="exampleFormControlSelect44">
                                  <option selected disabled>المدينة</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                                  <option>5</option>
                                </select>
                              </div>
                              <h3 class="mt-5">السعر</h3>

                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                <label class="form-check-label" for="inlineRadio1">ثابت</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                <label class="form-check-label" for="inlineRadio2">على سوم</label>
                              </div>
                              <h3 class="mt-5">صلاحية الإستمارة</h3>

                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions1" id="inlineRadio11" value="option11">
                                <label class="form-check-label" for="inlineRadio11">نعم</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions1" id="inlineRadio22" value="option22">
                                <label class="form-check-label" for="inlineRadio22"> لا</label>
                              </div>
                              <h3 class="mt-5">صلاحية الفحص الدوري</h3>

                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions11" id="inlineRadio111" value="option111">
                                <label class="form-check-label" for="inlineRadio11">نعم</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions11" id="inlineRadio222" value="option222">
                                <label class="form-check-label" for="inlineRadio222">لا</label>
                              </div>
                              <h3 class="mt-5 mb-3"> أضف ملاحظة</h3>
                              <div class="form-group">
                                <input type="text" class="form-control" id="car-2" placeholder="أضرار المركبة">
                              </div>
                              <div class="form-group custom-custom-2">
                                <div class="row">
                                  <div class="custom-file col-md-3 ml-2">
                                    <input type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile"></label>
                                  </div>
                                  <div class="custom-file col-md-3 ml-2">
                                    <input type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile"></label>
                                  </div>
                                  <div class="custom-file col-md-3">
                                    <input type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile"></label>
                                  </div>
                                </div>
                              </div>


                              <button type="submit" class="btn btn-next btn-block btn-lg">إرسال</button>

                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table mt-5 tabel-order">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">رقم السيارة </th>
                            <th scope="col">الصورة </th>
                            <th scope="col">العنوان </th>
                            <th scope="col">أثرية </th>
                            <th scope="col">نوع السيارة </th>
                            <th scope="col">السعر </th>
                            <th scope="col">المزايدين </th>
                            <th scope="col">تاريخ الطلب </th>


                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">134</th>
                            <td><img src="assets/images/profile-piece.png" alt=""> </td>
                            <td>الرياض حي النسيم</td>
                            <td>نعم</td>
                            <td>نوع</td>
                            <td>12000</td>
                            <td>
                              <p>اسم المزايد</p>
                              <p>اسم المزايد</p>
                              <p>اسم المزايد</p>

                            </td>
                            <td>
                              12 سبتمبر 2020</td>


                          </tr>
                          <tr>
                            <th scope="row">134</th>
                            <td><img src="assets/images/profile-piece.png" alt=""> </td>
                            <td>الرياض حي النسيم</td>
                            <td>نعم</td>
                            <td>نوع</td>
                            <td>12000</td>
                            <td>
                              <p>اسم المزايد</p>
                              <p>اسم المزايد</p>
                              <p>اسم المزايد</p>

                            </td>
                            <td>12 سبتمبر 2020</td>


                          </tr>
                          <tr>
                            <th scope="row">134</th>
                            <td><img src="assets/images/profile-piece.png" alt=""> </td>
                            <td>الرياض حي النسيم</td>
                            <td>نعم</td>
                            <td>نوع</td>
                            <td>12000</td>
                            <td>
                              <p>اسم المزايد</p>
                              <p>اسم المزايد</p>
                              <p>اسم المزايد</p>

                            </td>
                            <td>12 سبتمبر 2020</td>


                          </tr>
                          <tr>
                            <th scope="row">134</th>
                            <td><img src="assets/images/profile-piece.png" alt=""> </td>
                            <td>الرياض حي النسيم</td>
                            <td>نعم</td>
                            <td>نوع</td>
                            <td>12000</td>
                            <td>
                              <p>اسم المزايد</p>
                              <p>اسم المزايد</p>
                              <p>اسم المزايد</p>

                            </td>
                            <td>12 سبتمبر 2020</td>


                          </tr>


                        </tbody>
                      </table>
                    </div>
              
                  </div>
                </div>

              </div>