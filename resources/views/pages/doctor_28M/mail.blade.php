<center>
    <table align="center" border="0" cellpadding="0" cellspacing="0" style="height:100%; width:600px;">
        <!-- BEGIN EMAIL -->
        <tr>
          <td align="center" bgcolor="#ffffff" style="padding:30px">
             <p style="text-align:left">Hello,<br><br>
             We received a request to reset the password for your account for this email address.
            To initiate the password reset process for your account, click the link below.
            </p>
            {{-- <a href="{{ route('doctor.reset', $token) }}">Reset Password</a> --}}

            <p>
              <a target="_blank" style="text-decoration:none; background-color: black; border: black 1px solid; color: #fff; padding:10px 10px; display:block;" href="{{ $data1["reset_url"] }}">
            <strong>Reset Password</strong></a>
            </p>
            <p style="text-align:left">This link can only be used once.
            If you need to reset your password again, please visit
            <a href="{{ $data1["site_url"] }}">BABYAMA</a> and request another reset.
            <br><br>If you did not make this request, you can simply ignore this email.</p>
            <p style="text-align:left">
                Best,<br>The BABYAMA TEAM
            </p>
          </td>
        </tr>
      </tbody>
    </table>
  </center>
