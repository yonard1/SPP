# TODO: Fix Route [pembayaran.create] not defined

## Steps to Complete

1. **Update PembayaranController.php** ✅
   - In `index()` method: Add logic to determine the correct route prefix based on auth guard (admin or petugas) and pass `createRoute` variable to the view.
   - In `create()` method: Add logic to pass `storeRoute` variable to the view.

2. **Update routes/web.php** ✅
   - Ensure pembayaran routes have explicit prefixed names (already done via group naming, but verify).

3. **Update resources/views/pembayaran/index.blade.php** ✅
   - Change `$data` to `$pembayaran` in the foreach loop.
   - Use `{{ $createRoute }}` for the "Tambah Transaksi" link.

4. **Update resources/views/pembayaran/create.blade.php** ✅
   - Change form action to `{{ route($storeRoute) }}`.
   - Update form fields: Add `tgl_bayar` (date input), `tahun_dibayar` (select or input), change `nominal` to `jumlah_bayar`, ensure `bulan` is `bulan_dibayar`.

5. **Test the Application**
   - Run the app and navigate to pembayaran index and create pages to verify routes are defined and working.
