@extends("/frontend/layouts/template/template")

@section("content")
<div class="container-fluid">
    <center><h2>FAQ<hr width="50px;" style="border-top:5px solid rgb(255 194 49 / 47%)"></h2></center>
</div><br>

<div class="container-fluid" style="margin-bottom: 20px;">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="b-faq">
                <div class="faq__item">
                    <a href="#" class="faq__title js-faq-title">
                        <div class="faq__spoiler js-faq-rotate"><span class="faq__symbol ">+</span></div> 
                        <span class="faq__text">ฟิล์มไฮโดรเจลดีกว่าฟิล์มชนิดอื่นอย่างไร ?</span>
                    </a>
                    <div class="faq__content js-faq-content">
                        ฟิล์มของเรา รับแรงกระแทกได้ในระดับหนึ่ง กันรอยขีดข่วนได้ดี ทนทาน ไม่ต้องเปลี่ยนฟิล์มบ่อยๆ เป็นการช่วยประหยัดเงินในการจะต้องเปลี่ยนฟิล์มบ่อยๆ
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="b-faq">
                <div class="faq__item">
                    <a href="#" class="faq__title js-faq-title">
                        <div class="faq__spoiler js-faq-rotate"><span class="faq__symbol ">+</span></div> 
                        <span class="faq__text">ฟิล์มไฮโดรเจลมีกี่แบบ ?</span>
                    </a>
                    <div class="faq__content js-faq-content">
                        ในส่วนของบริษัทเรา จะมีให้เลือก 5 แบบ <br>
                        1. High Clear หรือฟิล์มแบบใส ตัวนี้จะเหมาะกับคนที่มองจอไม่ค่อยชัด แสงจอจะไม่ดรอปลง หน้าจอคงความสดใสของสี และช่วยให้จอมีความชัดขึ้น<br>
                        2. Matt หรือฟิล์มแบบด้าน สำหรับผู้ใช้ที่มีเหงื่อบนมือและนิ้วจำนวนมาก ขณะใช้โทรศัพท์ ซึ่งตัวฟิล์มจะไม่เก็บคราบจากไขมัน และคราบเหงื่อบนหน้าจอ เป็นสินค้าที่ชื่นชอบของผู้ที่ชอบเล่นเกมส์ เป็นอย่างมาก<br>
                        3. Privacy หรือฟิล์มแบบช่วยสร้างความเป็นส่วนตัวยิ่งขึ้น เนื่องจากหากผู้อื่นที่มองมาจะไม่เห็นรายละเอียดใดๆของเรา<br>
                        4. Anti-Blue หรือ ฟิล์มตัดแสงสีฟ้าจากจอโทรศัพท์ เพื่อช่วยถนอมสายตา<br>
                        5. Wolverine หรือฟิล์มแบบฟื้นฟูตัวเอง อันนี้เป็นสินค้าสุดพิเศษที่ทางเราตั้งชื่อขึ้นมา ด้วยคุณสมบัติที่ล้ำเหนือใคร ในการฟื้นฟูตัวเองได้จากการยุบตัวของฟิล์มจะทำการคืนตัวภายใน 24 ชม มาพร้อมกับทำให้หน้าจอชัดเจนขึ้นมากกว่าเดิม 
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="b-faq">
                <div class="faq__item">
                    <a href="#" class="faq__title js-faq-title">
                        <div class="faq__spoiler js-faq-rotate"><span class="faq__symbol ">+</span></div> 
                        <span class="faq__text">ถ้าฟิล์มเสื่อมสภาพลงแล้วเวลาแกะออกจะมีคราบติดเครื่องและจอโทรศัพท์หรือไม่ ?</span>
                    </a>
                    <div class="faq__content js-faq-content">
                        ฟิล์มไฮโดรเจลเมื่อแกะออกจะไม่ทิ้งคราบกาวใดๆ เพราะเนื้อฟิล์มไฮโดรเจลของเรามีคุณสมบัติของกาวเป็นพิเศษแกะออกง่าย ไม่ทิ้งคราบกาว ไม่ส่งผลด้านลบ ต่อตัวเครื่องทั้งยังช่วยป้องกันเคสกัดเครื่องอีกด้วย
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="b-faq">
                <div class="faq__item">
                    <a href="#" class="faq__title js-faq-title">
                        <div class="faq__spoiler js-faq-rotate"><span class="faq__symbol ">+</span></div> 
                        <span class="faq__text">หลังติดฟิล์มแล้วเกิดฟองอากาศเล็กๆ ขึ้นและมีรอยขีดตรงกลาง รอยพวกนี้จะหายไปหรือไม่ ?</span>
                    </a>
                    <div class="faq__content js-faq-content">
                        ด้วยเทคโนโลยีของฟิล์มไฮโรเจล ของเราจะต้องใช้เวลา 24 ชม. ในการคืนตัวหลังจาดติดแล้วฟองอากาศจะหายไปภายใน 24 ชั่วโมงหลัง ทางเราเลือกใช้วิธีรอให้สภาพฟิล์มเซ็ตตัว แบบธรรมชาติ
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="b-faq">
                <div class="faq__item">
                    <a href="#" class="faq__title js-faq-title">
                        <div class="faq__spoiler js-faq-rotate"><span class="faq__symbol ">+</span></div> 
                        <span class="faq__text">ฟิล์มไฮโดรเจล สามารถติดกับมือถือรุ่นไหนได้บ้าง ?</span>
                    </a>
                    <div class="faq__content js-faq-content">
                        สินค้าจากบริษัทเราสามารถรองรับโทรศัพท์ได้มากถึง 10,000 รุ่น ด้วยเครื่องตัดที่ดีที่สุด อัพรุ่นใหม่ทุกปี
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="b-faq">
                <div class="faq__item">
                    <a href="#" class="faq__title js-faq-title">
                        <div class="faq__spoiler js-faq-rotate"><span class="faq__symbol ">+</span></div> 
                        <span class="faq__text">ฟิล์มไอโดรเจล สามารถคลุมจอโทรศัพท์ทีมีความโค้งได้หรือไม่ ?</span>
                    </a>
                    <div class="faq__content js-faq-content">
                        คุณสมบัติพิเศษของฟิล์มไฮโดรเจลมีความยืดหยุ่นได้สูง จึงไม่เป็นปัญหาในส่วนโค้งของจอ
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="b-faq">
                <div class="faq__item">
                    <a href="#" class="faq__title js-faq-title">
                        <div class="faq__spoiler js-faq-rotate"><span class="faq__symbol ">+</span></div> 
                        <span class="faq__text">เวลาติดฟิล์มจะมีปัญหาเรื่องการสแกนนิ้วยากหรือไม่ ?</span>
                    </a>
                    <div class="faq__content js-faq-content">
                        ฟิล์มไฮโดรเจลไม่มีปัญหาในส่วนนี้ แต่อาจจะมีปัญหาในส่วนของ ฟิล์ม Privacy ซึ้งมีความหนาเป็นพิเศษจะทำให้ระบบสแกนนี้อ่านค่าไม่ได้ เราจึงใช้วิธีตัดในส่วนที่ต้องใช้นิ้วสแกน แต่กรณีโทรศัพท์ที่ไม่มีตัวสแกนแยก ก็จะขึ้นอยู่ที่ยี่ห้อโทรศัพท์ เนื่องจากเราได้ทำการทดลองแล้ว
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="b-faq">
                <div class="faq__item">
                    <a href="#" class="faq__title js-faq-title">
                        <div class="faq__spoiler js-faq-rotate"><span class="faq__symbol ">+</span></div> 
                        <span class="faq__text">ทางร้านรับประกันสินค้าหรือไม่ และทำอย่างไร ?</span>
                    </a>
                    <div class="faq__content js-faq-content">
                        สำหรับการรับประกันจะนับตั้งแต่วันที่ได้รับสินค้า โดยที่คุณลูกค้า สามารถเข้าไปทำการลงทะเบียนภายใน 7 วันเท่านั้น หากเกินจากนี้ สินค้าจะไม่สามารถลงทะเบียนได้ โดยขั้นตอนแรกคุณลูกค้า เข้าไปที่เว็บไซต์ www.ptk888.com แล้วคลิกที่แถบสีส้มมุมขวา “ลงทะเบียนรับประกันฟิล์ม” หลังจากนั้นกรอกข้อมูลตามแบบฟอร์มตามลำดับขั้นตอนของระบบ
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="b-faq">
                <div class="faq__item">
                    <a href="#" class="faq__title js-faq-title">
                        <div class="faq__spoiler js-faq-rotate"><span class="faq__symbol ">+</span></div> 
                        <span class="faq__text">ฟิล์มไฮโดรเจลทุกตัวที่ร้าน มีประกันให้ทั้งหมดใช่หรือไม่ ?</span>
                    </a>
                    <div class="faq__content js-faq-content">
                        ทางร้านเรามีการรับประกันสินค้าให้ดังนี้<br>
                        - มาดามฟิล์ม รับประกัน 365 วันทุกกรณี<br>
                        - โดราซิลล์ 60 วันทุกกรณี<br>
                        การรับประกันจะอยู่ภายใต้เงื่อนไข ข้อกำหนดของบริษัทเท่านั้น
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="b-faq">
                <div class="faq__item">
                    <a href="#" class="faq__title js-faq-title">
                        <div class="faq__spoiler js-faq-rotate"><span class="faq__symbol ">+</span></div> 
                        <span class="faq__text">ทำไมมาดามฟิล์มแพงกว่าโดราชิลล์ ?</span>
                    </a>
                    <div class="faq__content js-faq-content">
                        เนื่องด้วยคุณภาพฟิล์มและการรับประกันดังนี้<br>
                        - มาดามฟิล์ม แผ่นฟิล์มหนา 4 ชั้น การผลิตที่เป็นพิเศษ เพิ่มคุณภาพของฟิล์มทั้ง 5 แบบ และรับประกัน 365 วันทุกกรณี<br>
                        - โดราซิลล์ แผ่นฟิล์มหนา 4 ชั้น การผลิตที่รองลงมาจากตัวสินค้ามาดามฟิล์ม และรับประกัน 90 วันทุกกรณี
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="b-faq">
                <div class="faq__item">
                    <a href="#" class="faq__title js-faq-title">
                        <div class="faq__spoiler js-faq-rotate"><span class="faq__symbol ">+</span></div> 
                        <span class="faq__text">ฟิล์มไฮโดรเจล ที่ถนอมสายตามีด้วยหรือไม่ เป็นฟิล์มแบบไหน ?</span>
                    </a>
                    <div class="faq__content js-faq-content">
                        ฟิล์มไฮโดรเจลถนอมสายตา  Anti-Blue ตัดแสงสีฟ้าจากหน้าจอมือถือ เหมาะสำหรับผู้ที่ใช้งานมือถือติดต่อกันเป็นเวลานาน มีให้เลือก 2 แบรนด์<br>
                        - มาดามฟิล์ม มาพร้อมกันการรับประกัน 365 วันทุกกรณี<br>
                        - โดราซิลล์ มาพร้อมกันการรับประกัน 60 วันทุกกรณี
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="b-faq">
                <div class="faq__item">
                    <a href="#" class="faq__title js-faq-title">
                        <div class="faq__spoiler js-faq-rotate"><span class="faq__symbol ">+</span></div> 
                        <span class="faq__text">ฟิล์มไฮโดรเจล ที่เหมาะกับการเล่นเกมส์ได้ดีสุด ทางร้านนะนำฟิล์มประเภทไหนเหมาะที่สุด ?</span>
                    </a>
                    <div class="faq__content js-faq-content">
                        เราขอแนะนำจากผู้ใช้จริงที่นิยมที่สุด อันดับหนึ่งเป็นฟิล์มด้าน เนื่องจากผู้ใช้ส่วนมากมักมีเหงื่อออกจากมือเมื่อเล่นไปแล้วทำให้หน้าจอมีความชื้น ทัชไม่ไป แต่ฟิล์มด้านคุณสมบัติไม่เก็บคราบไขมันจึงตอบโจทย์มากที่สุด สำหรับผู้ที่มีเหงื่อที่มือ ปริมาณน้อยหรือไม่มีเลย แนะนำฟิล์มวูฟเวอรีนที่ให้ค่าความชัดของจอเยอะเป็นพิเศษ
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="b-faq">
                <div class="faq__item">
                    <a href="#" class="faq__title js-faq-title">
                        <div class="faq__spoiler js-faq-rotate"><span class="faq__symbol ">+</span></div> 
                        <span class="faq__text">ฟิล์มไฮโดรเจล กับ ฟิล์มกระจก แตกต่างกันอย่างไร ?</span>
                    </a>
                    <div class="faq__content js-faq-content">
                        1. ด้านความหนาของฟิล์ม ฟิล์มกระจกหนา 0.6 มม. ส่วนฟิล์มไฮโดรเจลหนาเพียง 0.2 มม. ทำให้สบายตา และน้ำหนักเบากว่า<br>
                        2. ความยืดหยุ่นของฟิล์มไฮโดรเจลมีมากกว่าตกไม่แตก ส่วนฟิล์มกระจกตกแล้วจะมีรอยร้าวหรือรอยแตกเป็นเศษกระจก มีโอกาสบาดมือได้ง่าย หากขอบของฟิล์มกระจกบิ่นก็จำเป็นต้องเปลี่ยน<br>
                        3. ด้านการกันกระแทก ฟิล์มกระจกแตกละเอียดเมื่อถูกแรงกระแทก ส่วนฟิล์มไฮโดรเจลรับแรงกระแทกและกระจายแรงกระแทก ไม่แตก อีกทั้งสินค้าบางรุ่นยังสามารถซ่อมแซมหน้าจอตัวเองให้กลับมาอยู่ในสภาพเดิมได้อีกด้วย 
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="b-faq">
                <div class="faq__item">
                    <a href="#" class="faq__title js-faq-title">
                        <div class="faq__spoiler js-faq-rotate"><span class="faq__symbol ">+</span></div> 
                        <span class="faq__text">ฟิล์มไฮโดรเจลตกแล้วมือถือจะแตกมั้ย ?</span>
                    </a>
                    <div class="faq__content js-faq-content">
                        จากการทำลองฟิล์มไฮโดรเจล ทนต่อแรงกระแทรกได้ในระดับหนึ่ง เช่นตกจากระดับความสูงไม่เกิน 1 เมตร แต่จะไม่สามารถรับแรงกระแทกในกรณีเกิดอุบัติเหตุรุนแรงกว่าปกติได้ หากคุณลูกค้าเป็นท่านนึงที่ทำมือถือตกบ่อยๆ เราขอแนะนำเป็นฟิล์มแบบวูล์ฟเวอรีน-ฟื้นฟูตัวเอง ซ่อมแซมตัวเองหลังจากเกิดรอยขีดข่วนให้กลับมาใสภายใน 24 ชั่วโมง กรณีอุบัติเหตุ ขึ้นอยู่กับลักษณะของการกระแทกหากกระแทกกับสิ่งของที่มีความแหลมคม ก็ไม่สามารถป้องกันได้
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="b-faq">
                <div class="faq__item">
                    <a href="#" class="faq__title js-faq-title">
                        <div class="faq__spoiler js-faq-rotate"><span class="faq__symbol ">+</span></div> 
                        <span class="faq__text">เงื่อนไขการรับประกันมาดามฟิล์มเป็นอย่างไร ?</span>
                    </a>
                    <div class="faq__content js-faq-content">
                        สำหรับแบร์นมาดามฟิล์ม มีการรับประกันทุกกรณี 365 วัน และจะสามารถเคลมได้ 1 ครั้งเท่านั้น
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="b-faq">
                <div class="faq__item">
                    <a href="#" class="faq__title js-faq-title">
                        <div class="faq__spoiler js-faq-rotate"><span class="faq__symbol ">+</span></div> 
                        <span class="faq__text">เงื่อนไขการรับประกันฟิล์ม Dora เป็นอย่างไร ?</span>
                    </a>
                    <div class="faq__content js-faq-content">
                        สำหรับแบร์นโดราฟิล์ม มีการรับประกันทุกกรณี 90 วัน และจะสามารถเคลมได้ 1 ครั้งเท่านั้น
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="b-faq">
                <div class="faq__item">
                    <a href="#" class="faq__title js-faq-title">
                        <div class="faq__spoiler js-faq-rotate"><span class="faq__symbol ">+</span></div> 
                        <span class="faq__text">ฟิล์มไฮโดรเจล มีข้อเสียมั้ย ?</span>
                    </a>
                    <div class="faq__content js-faq-content">
                        สำหรับการใช้งานปกติ ทางเรายังไม่พบข้อเสียในขณะนี้ เนื่องจากฟิล์มไฮโดรเจลเป็นนวัตกรรมใหม่ที่ถูกพัฒนาขึ้นเพื่อตอบโจทย์ความต้องการและการใช้งานของคุณลูกค้าในทุกๆ ด้าน
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="b-faq">
                <div class="faq__item">
                    <a href="#" class="faq__title js-faq-title">
                        <div class="faq__spoiler js-faq-rotate"><span class="faq__symbol ">+</span></div> 
                        <span class="faq__text">ฟิล์มป้องกันความเป็นส่วนตัว ป้องกันได้อย่างไร ?</span>
                    </a>
                    <div class="faq__content js-faq-content">
                        ในขณะที่เราใช้งาน ผู้อื่นจะไม่สามารถมองเห็นจอของเราได้ชัด จะสามารถมองเห็นเป็นหน้าจอมืดๆ เท่านั้น ซึ่งขึ้นอยู่กับองศาของการมอง
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="b-faq">
                <div class="faq__item">
                    <a href="#" class="faq__title js-faq-title">
                        <div class="faq__spoiler js-faq-rotate"><span class="faq__symbol ">+</span></div> 
                        <span class="faq__text">ทำไมฟิล์มไฮโดรเจลของบริษัท ถึงราคาแพงกว่าฟิล์มทั่วไป ?</span>
                    </a>
                    <div class="faq__content js-faq-content">
                        สำหรับฟิล์มกันกระแทกชนิดไฮโดรเจล มีหลากหลายเกรดการผลิต เช่นเดียวกับสินค้าทุกประเภท เราทำการทดลองมาค่อนข้างเยอะ เพื่อเปรียบเทียบข้อแตกต่าง และได้ข้อสรุปของคุณภาพฟิล์มที่ดีที่สุดในการวางจำหน่าย อีกทั้งเรายังกล้ารับประกันคุณภาพสินค้าให้กับทางลูกค้าอีกด้วย
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="b-faq">
                <div class="faq__item">
                    <a href="#" class="faq__title js-faq-title">
                        <div class="faq__spoiler js-faq-rotate"><span class="faq__symbol ">+</span></div> 
                        <span class="faq__text">หากต้องการเคลมสินค้าต้องทำอย่างไร ?</span>
                    </a>
                    <div class="faq__content js-faq-content">
                        คุณลูกค้าสามารถเข้าไปที่เว็บไซต์ของเรา www.ptk888.com แล้วคลิกที่ “ใช้สิทธิ์เคลมสินค้า” กรอกข้อมูลตามระบบ และทำการส่งสินค้าตัวเก่ากลับมายังบริษัท โดยคุณลูกค้าจะต้องเป็นผู้ชำระในส่วนของค่าส่งนี้ หลังจากนั้น ทางบริษัทจะทำการจัดส่งสินค้าตัวใหม่พร้อมกับรับผิดชอบในส่วนของค่าส่งให้อีกด้วย 
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
	

<script type="text/javascript" src="{{asset('https://code.jquery.com/jquery-3.2.1.min.js')}}"></script>
<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
<script>
    $(function() {
	
	//BEGIN
	$(".js-faq-title").on("click", function(e) {

		e.preventDefault();
		var $this = $(this);

		if (!$this.hasClass("faq__active")) {
			$(".js-faq-content").slideUp(800);
			$(".js-faq-title").removeClass("faq__active");
			$('.js-faq-rotate').removeClass('faq__rotate');
		}

		$this.toggleClass("faq__active");
		$this.next().slideToggle();
		$('.js-faq-rotate',this).toggleClass('faq__rotate');
	});
	//END
	
});
</script>

@endsection