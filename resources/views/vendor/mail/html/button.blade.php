<table class="action" align="center" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center">
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                                    <button class="button button-{{ $color ?? 'primary' }}" disabled><strong>
                                            <h4>{{ $slot }}</h4>
                                        </strong></button>
                                    <!-- <a href="#" class="button button-{{ $color ?? 'primary' }}"disabled>{{ $slot }}</a> -->
                                    <!-- {{ $url }} -->
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>