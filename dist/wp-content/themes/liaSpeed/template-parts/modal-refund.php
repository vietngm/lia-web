  <div class="modal-content">
    <div class="modal-header">
      <h2><?php the_title();?></h2>
      <span class="close-modal">&times;</span>
    </div>
    <div class="modal-body">
      <div class="policy-details">
        <div class="policy-section">
          <?php
          $content = get_field('content',get_the_ID());
          echo $content[0]['content'];
          ?>
          <h3>Điều kiện hoàn tiền</h3>
          <p>LIA cam kết hoàn tiền trong các trường hợp:</p>
          <ul>
            <li>Không thực hiện đúng cam kết về thời gian khai trương</li>
            <li>Không cung cấp đủ thiết bị và dịch vụ như đã cam kết trong hợp đồng</li>
            <li>Phát sinh lỗi nghiêm trọng không thể khắc phục trong quá trình vận hành</li>
          </ul>
        </div>

        <div class="policy-section">
          <h3>Tỷ lệ hoàn tiền</h3>
          <div class="refund-rates">
            <div class="refund-rate-item">
              <div class="rate-circle">100%</div>
              <p>Trước khi ký hợp đồng chính thức</p>
            </div>
            <div class="refund-rate-item">
              <div class="rate-circle">80%</div>
              <p>Sau khi ký hợp đồng, trước khi lên thiết kế</p>
            </div>
            <div class="refund-rate-item">
              <div class="rate-circle">50%</div>
              <p>Sau khi phê duyệt thiết kế, trước khi thi công</p>
            </div>
            <div class="refund-rate-item">
              <div class="rate-circle">30%</div>
              <p>Trong quá trình thi công, trước khi nghiệm thu</p>
            </div>
          </div>
        </div>

        <div class="policy-section">
          <h3>Quy trình hoàn tiền</h3>
          <ol>
            <li>Gửi yêu cầu hoàn tiền bằng văn bản chính thức đến bộ phận CSKH</li>
            <li>LIA sẽ xác nhận và xem xét yêu cầu trong vòng 7 ngày làm việc</li>
            <li>Nếu yêu cầu được chấp thuận, tiền sẽ được hoàn trả trong vòng 15 ngày làm việc</li>
            <li>Số tiền hoàn trả sẽ được chuyển vào tài khoản ngân hàng của khách hàng</li>
          </ol>
        </div>

        <div class="policy-note">
          <p><strong>Lưu ý:</strong> Phí chuyển khoản và các chi phí liên quan đến việc hoàn tiền (nếu có) sẽ do khách
            hàng chi trả. LIA cam kết minh bạch và công bằng trong việc xử lý các yêu cầu hoàn tiền.</p>
        </div>
      </div>
    </div>
  </div>