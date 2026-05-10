<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    /**
     * Almacena una nueva dirección de envío.
     */
    public function store(Request $request)
    {
        $request->validate([
            'alias'    => ['nullable', 'string', 'max:100'],
            'phone'    => ['nullable', 'string', 'max:20'],
            'street'   => ['required', 'string', 'max:255'],
            'city'     => ['required', 'string', 'max:100'],
            'state'    => ['nullable', 'string', 'max:100'],
            'zip_code' => ['required', 'string', 'max:20'],
            'country'  => ['required', 'string', 'max:100'],
            'is_default' => ['boolean'],
        ]);

        try {
            DB::beginTransaction();

            $isDefault = $request->boolean('is_default');

            if ($request->user()->addresses()->count() === 0) {
                $isDefault = true;
            }

            if ($isDefault) {
                $request->user()->addresses()->update(['is_default' => false]);
            }

            $request->user()->addresses()->create([
                'alias'      => $request->alias,
                'phone'      => $request->phone,
                'street'     => $request->street,
                'city'       => $request->city,
                'state'      => $request->state,
                'zip_code'   => $request->zip_code,
                'country'    => $request->country,
                'is_default' => $isDefault,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', __('messages.address_create_error'));
        }

        return back()->with('mensaje', __('messages.address_created'));
    }

    /**
     * Actualiza una dirección de envío existente.
     */
    public function update(Request $request, $id)
    {
        $address = Address::findOrFail($id);

        if ($address->user_id !== $request->user()->id) {
            abort(403);
        }

        $request->validate([
            'alias'    => ['nullable', 'string', 'max:100'],
            'phone'    => ['nullable', 'string', 'max:20'],
            'street'   => ['required', 'string', 'max:255'],
            'city'     => ['required', 'string', 'max:100'],
            'state'    => ['nullable', 'string', 'max:100'],
            'zip_code' => ['required', 'string', 'max:20'],
            'country'  => ['required', 'string', 'max:100'],
            'is_default' => ['boolean'],
        ]);

        try {
            DB::beginTransaction();

            $isDefault = $request->boolean('is_default');

            if ($isDefault) {
                $request->user()->addresses()->where('id', '!=', $id)->update(['is_default' => false]);
            }

            $address->update([
                'alias'      => $request->alias,
                'phone'      => $request->phone,
                'street'     => $request->street,
                'city'       => $request->city,
                'state'      => $request->state,
                'zip_code'   => $request->zip_code,
                'country'    => $request->country,
                'is_default' => $isDefault,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', __('messages.address_update_error'));
        }

        return back()->with('mensaje', __('messages.address_updated'));
    }

    /**
     * Elimina una dirección de envío.
     */
    public function destroy(Request $request, $id)
    {
        $address = Address::findOrFail($id);

        if ($address->user_id !== $request->user()->id) {
            abort(403);
        }

        try {
            DB::beginTransaction();

            $wasDefault = $address->is_default;
            $address->delete();

            if ($wasDefault) {
                $first = $request->user()->addresses()->first();
                if ($first) {
                    $first->update(['is_default' => true]);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', __('messages.address_delete_error'));
        }

        return back()->with('mensaje', __('messages.address_deleted'));
    }

    /**
     * Marca una dirección como predeterminada.
     */
    public function setDefault(Request $request, $id)
    {
        $address = Address::findOrFail($id);

        if ($address->user_id !== $request->user()->id) {
            abort(403);
        }

        try {
            DB::beginTransaction();

            $request->user()->addresses()->update(['is_default' => false]);

            $address->update(['is_default' => true]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', __('messages.address_default_error'));
        }

        return back()->with('mensaje', __('messages.address_default_updated'));
    }
}
